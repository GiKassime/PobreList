function marcar(btn) {
    // id do item e novo estado (0 ou 1)
    const id = btn.dataset.itemId;
    const novo = btn.dataset.comprado === '1' ? '0' : '1';

    // evita mts cliques
    btn.disabled = true;

    // preparar payload
    const dados = new FormData();
    dados.append('id', id);
    dados.append('comprado', novo);

    // enviar requisição
    const xhr = new XMLHttpRequest();
    xhr.open('POST', '../../api/marcar_item.php');

    xhr.onload = function () {
        // reabilita botão
        btn.disabled = false;
        res = JSON.parse(xhr.responseText);

        // localizar elementos do DOM relacionados ao item
        const card = btn.closest('.item-card');
        const coluna = card ? card.closest('.col') : null;
        const destino = res.comprado == 1 ? document.getElementById('cards-comprados') : document.getElementById('cards-nao-comprados');

        // mover o card para o container correto
        if (coluna && destino) {
            destino.prepend(coluna);
        }

        // atualizar totais 
        const preco = card && card.dataset.price ? parseFloat(card.dataset.price) || 0 : 0;
        const totalNaoEl = document.getElementById('total-nao-comprados');
        const totalCompEl = document.getElementById('total-comprados');

        if (preco && totalNaoEl && totalCompEl) {
            let totalNao = parseMoeda(totalNaoEl.innerText);
            let totalComp = parseMoeda(totalCompEl.innerText);

            if (res.comprado == 1) {
                totalNao = Math.max(0, totalNao - preco);
                totalComp += preco;
            } else {
                totalComp = Math.max(0, totalComp - preco);
                totalNao += preco;
            }

            totalNaoEl.innerText = 'TOTAL: R$ ' + formatarMoeda(totalNao);
            totalCompEl.innerText = 'TOTAL GASTO: R$ ' + formatarMoeda(totalComp);
        }

        // atualizar aparência do botao
        btn.dataset.comprado = res.comprado == 1 ? '1' : '0';
        if (res.comprado == 1) {
            btn.classList.remove('btn-outline-secondary');
            btn.classList.add('btn-success');
            btn.title = 'Desmarcar como comprado';
            btn.innerHTML = '<i class="bi bi-check2-circle mx-1"></i>Comprado';
        } else {
            btn.classList.remove('btn-success');
            btn.classList.add('btn-outline-secondary');
            btn.title = 'Marcar como comprado';
            btn.innerHTML = '<i class="bi bi-circle mx-1"></i>Marcar';
        }
    };
    xhr.send(dados);
}

/**
 * Parse simples de texto no formato "R$ 1.234,56" para Number.
 */
function parseMoeda(text) {
    const m = (text || '').match(/R\$\s*([0-9\.\,]+)/);
    if (!m) return 0;
    return parseFloat(m[1].replace(/\./g, '').replace(/,/g, '.')) || 0;
}

/**
 * Formata número para moeda BR.
 */
function formatarMoeda(n) {
    return n.toLocaleString('pt-BR', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
}

// wrapper compatível com onclick="Marcar(this)"
function Marcar(btn) { return marcar(btn); }
