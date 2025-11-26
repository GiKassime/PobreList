// envia POST, move o cartão e atualiza os totais
function marcar(btn) {
    const idItem = btn.dataset.itemId;
    const novoEstado = btn.dataset.comprado === '1' ? '0' : '1';
    btn.disabled = true; // evita clicks repetidos

    const dados = new FormData();
    dados.append('id', idItem);
    dados.append('comprado', novoEstado);

    const requisicao = new XMLHttpRequest();
    requisicao.open('POST', '../../api/marcar_item.php');
    requisicao.onload = function () {
        btn.disabled = false;

        const cartao = btn.closest('.item-card');
        const coluna = cartao ? cartao.closest('.col') : null;
        const destino = resposta && resposta.comprado == 1 ? document.getElementById('cards-comprados') : document.getElementById('cards-nao-comprados');

        if (coluna && destino) destino.prepend(coluna);

        // atualizar totais
        const preco = cartao && cartao.dataset.price ? parseFloat(cartao.dataset.price) || 0 : 0;

        const totalNaoEl = document.getElementById('total-nao-comprados');
        const totalCompradoEl = document.getElementById('total-comprados');

        if (preco && totalNaoEl && totalCompradoEl) {
            let totalNao = parseMoeda(totalNaoEl.innerText);
            let totalComp = parseMoeda(totalCompradoEl.innerText);

            if (resposta.comprado == 1) { totalNao = Math.max(0, totalNao - preco); totalComp += preco; }
            else { totalComp = Math.max(0, totalComp - preco); totalNao += preco; }

            totalNaoEl.innerText = 'TOTAL: R$ ' + formatarMoeda(totalNao);
            totalCompradoEl.innerText = 'TOTAL GASTO: R$ ' + formatarMoeda(totalComp);
        }

        // atualizar botão
        if (resposta.comprado == 1) {
            btn.dataset.comprado = '1'; btn.classList.remove('btn-outline-secondary'); btn.classList.add('btn-success');
            btn.title = 'Desmarcar como comprado'; btn.innerHTML = '<i class="bi bi-check2-circle mx-1"></i>Comprado';
        } else {
            btn.dataset.comprado = '0'; btn.classList.remove('btn-success'); btn.classList.add('btn-outline-secondary');
            btn.title = 'Macar como comprado'; btn.innerHTML = '<i class="bi bi-circle mx-1"></i>Marcar';
        }
    };
    requisicao.onerror = function () { btn.disabled = false; alert('Erro na requisição'); };
    requisicao.send(dados);
}

function parseMoeda(text) { const m = (text||'').match(/R\$\s*([0-9\.\,]+)/); if(!m) return 0; return parseFloat(m[1].replace(/\./g,'').replace(/,/g,'.'))||0; }

function formatarMoeda(n) { return n.toLocaleString('pt-BR',{minimumFractionDigits:2, maximumFractionDigits:2}); }

// wrapper compatível com onclick="Marcar(this)"
function Marcar(btn) { return marcar(btn); }
