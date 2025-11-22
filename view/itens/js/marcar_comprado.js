// envia POST, move card e atualiza totais 
function marcar(btn) {
    const id = btn.dataset.itemId;
    const novo = btn.dataset.comprado === '1' ? '0' : '1';
    btn.disabled = true;//evita clicks repetidos


    const fd = new FormData();
    fd.append('id', id);
    fd.append('comprado', novo);

    const xhr = new XMLHttpRequest();
    xhr.open('POST', '../../api/marcar_item.php');
    xhr.onload = function () {
        btn.disabled = false;
        

        const card = btn.closest('.item-card');
        const col = card ? card.closest('.col') : null;
        const target = res.comprado == 1 ? document.getElementById('cards-comprados') : document.getElementById('cards-nao-comprados');

        if (col && target) target.prepend(col);

        // atualizar totais se existir data-price e elementos
        const price = card && card.dataset.price ? parseFloat(card.dataset.price) || 0 : 0;

        const totalNaoEl = document.getElementById('total-nao-comprados');

        const totalCompEl = document.getElementById('total-comprados');

        if (price && totalNaoEl && totalCompEl) {
            let totalNao = parseCurrency(totalNaoEl.innerText);

            let totalComp = parseCurrency(totalCompEl.innerText);

            if (res.comprado == 1) { totalNao = Math.max(0, totalNao - price); totalComp += price; }

            else { totalComp = Math.max(0, totalComp - price); totalNao += price; }

            totalNaoEl.innerText = 'TOTAL: R$ ' + formatCurrency(totalNao);
            
            totalCompEl.innerText = 'TOTAL GASTO: R$ ' + formatCurrency(totalComp);
        }

        // atualizar botão
        if (res.comprado == 1) {
            btn.dataset.comprado = '1'; btn.classList.remove('btn-outline-secondary'); btn.classList.add('btn-success');
            btn.title = 'Desmarcar como comprado'; btn.innerHTML = '<i class="bi bi-check2-circle mx-1"></i>Comprado';
        } else {
            btn.dataset.comprado = '0'; btn.classList.remove('btn-success'); btn.classList.add('btn-outline-secondary');
            btn.title = 'Marcar como comprado'; btn.innerHTML = '<i class="bi bi-circle mx-1"></i>Marcar';
        }
    };
    xhr.onerror = function () { btn.disabled = false; alert('Erro na requisição'); };
    xhr.send(fd);
}

function parseCurrency(text) { const m = (text||'').match(/R\$\s*([0-9\.\,]+)/); if(!m) return 0; return parseFloat(m[1].replace(/\./g,'').replace(/,/g,'.'))||0; }

function formatCurrency(n) { return n.toLocaleString('pt-BR',{minimumFractionDigits:2, maximumFractionDigits:2}); }
