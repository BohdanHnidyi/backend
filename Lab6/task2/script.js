
document.getElementById('noteForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    const head = document.getElementById('title').value;
    const text = document.getElementById('content').value;

    const res = await fetch('add_note.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ title: head, content: text, user_id: 1 })
    });

    const msg = await res.text();
    alert(msg);
    refreshNotes();
});

async function refreshNotes() {
    const res = await fetch('get_notes.php');
    const notes = await res.json();
    const container = document.getElementById('notesContainer');
    container.innerHTML = '';
    notes.forEach(note => {
        const div = document.createElement('div');
        div.innerHTML = `
            <h4>${note.title}</h4>
            <pre>${note.content}</pre>
            <button onclick="removeNote(${note.id})">Видалити</button>
            <button onclick="changeNote(${note.id}, '${note.title}', '${note.content}')">Редагувати</button>
            <hr>
        `;
        container.appendChild(div);
    });
}

async function removeNote(id) {
    await fetch('delete_note.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ id })
    });
    refreshNotes();
}

async function changeNote(id, oldTitle, oldContent) {
    const newTitle = prompt('Новий заголовок', oldTitle);
    const newContent = prompt('Новий текст', oldContent);
    if (newTitle && newContent) {
        await fetch('update_note.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id, title: newTitle, content: newContent })
        });
        refreshNotes();
    }
}

refreshNotes();
