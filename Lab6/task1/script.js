
document.getElementById('registerForm').addEventListener('submit', async function(event) {
    event.preventDefault();
    const username = document.getElementById('name').value;
    const usermail = document.getElementById('email').value;
    const userpass = document.getElementById('password').value;

    const reply = await fetch('register.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ name: username, email: usermail, password: userpass })
    });

    const feedback = await reply.text();
    alert(feedback);
    fetchUsersList();
});

async function fetchUsersList() {
    const response = await fetch('get_users.php');
    const userList = await response.json();
    const listElement = document.getElementById('userList');
    listElement.innerHTML = '';
    userList.forEach(user => {
        const listItem = document.createElement('li');
        listItem.textContent = `${user.name} <${user.email}>`;
        listElement.appendChild(listItem);
    });
}
