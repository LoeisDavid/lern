(function () {
    'use strict';

    var form = document.querySelector('[data-dnd]');
    if (!form) { return; }

    var pool = form.querySelector('[data-list="pool"]');
    var answer = form.querySelector('[data-list="answer"]');
    var message = form.querySelector('[data-dnd-message]');
    var initialOrder = Array.prototype.slice.call(pool.children);
    var total = initialOrder.length;
    var dragged = null;

    function say(text) { message.textContent = text || ''; }

    function insertionPoint(list, y) {
        var closest = Number.NEGATIVE_INFINITY, ref = null;
        list.querySelectorAll('.dnd-block:not(.dragging)').forEach(function (el) {
            var box = el.getBoundingClientRect();
            var offset = y - box.top - box.height / 2;
            if (offset < 0 && offset > closest) { closest = offset; ref = el; }
        });
        return ref;
    }

    // Drag-and-drop (mouse dan browser yang mendukung drag di layar sentuh)
    form.addEventListener('dragstart', function (e) {
        var block = e.target.closest('.dnd-block');
        if (!block) { return; }
        dragged = block;
        block.classList.add('dragging');
        e.dataTransfer.effectAllowed = 'move';
        e.dataTransfer.setData('text/plain', block.dataset.id);
    });

    form.addEventListener('dragend', function () {
        if (dragged) { dragged.classList.remove('dragging'); }
        dragged = null;
    });

    [pool, answer].forEach(function (list) {
        list.addEventListener('dragover', function (e) {
            if (dragged) { e.preventDefault(); e.dataTransfer.dropEffect = 'move'; }
        });
        list.addEventListener('drop', function (e) {
            if (!dragged) { return; }
            e.preventDefault();
            list.insertBefore(dragged, insertionPoint(list, e.clientY));
            say('');
        });
    });

    // Kontrol tombol: alternatif untuk perangkat sentuh dan keyboard
    form.addEventListener('click', function (e) {
        var button = e.target.closest('[data-action]');
        if (!button) { return; }
        var action = button.dataset.action;

        if (action === 'reset') {
            initialOrder.forEach(function (el) { pool.appendChild(el); });
            say('');
            return;
        }

        var block = button.closest('.dnd-block');
        if (!block) { return; }

        if (action === 'add') { answer.appendChild(block); }
        if (action === 'remove') { pool.appendChild(block); }
        if (action === 'up' && block.previousElementSibling) {
            block.parentNode.insertBefore(block, block.previousElementSibling);
        }
        if (action === 'down' && block.nextElementSibling) {
            block.parentNode.insertBefore(block.nextElementSibling, block);
        }
        say('');
    });

    // Kirim urutan ID blok. Penilaian tetap dilakukan di server.
    form.addEventListener('submit', function (e) {
        var blocks = answer.querySelectorAll('.dnd-block');
        if (blocks.length !== total) {
            e.preventDefault();
            say('Gunakan semua ' + total + ' blok sebelum memeriksa jawaban.');
            return;
        }
        form.querySelectorAll('input[name="answer[]"]').forEach(function (el) { el.remove(); });
        blocks.forEach(function (block) {
            var input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'answer[]';
            input.value = block.dataset.id;
            form.appendChild(input);
        });
    });
})();