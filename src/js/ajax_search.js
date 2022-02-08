let name_search = document.getElementById('name-search');
let phone_search = document.getElementById('phone-search');
let email_search = document.getElementById('email-search');
let gender_search = document.getElementById('gender-search');

inputs = [name_search, phone_search, email_search, gender_search];;

inputs.forEach(input => {
    input.addEventListener('keyup', getUsers);
})

function getUsers() {
    let name = name_search.value;
    let phone = phone_search.value;
    let email = email_search.value;
    let gender = gender_search.value;
    let url = "Controllers/Users.php?full_name=" + name + "&phone=" + phone + "&email=" + email + "&gender=" + gender;
    populate_grid(url);
}

function process_response_json(data) {
    let json = data.substring(12).trim();
    if (json.length < 3) {
        document.getElementById("data").innerHTML = '';
    }
    json = json.substring(1, json.length - 1);
    return JSON.parse(json);
}

function populate_grid(url) {
    $.get(url, (data) => {
        let users = process_response_json(data);
        let output = '';
        users.forEach(user => {
            output += `<tr>` +
                `<td>${user.id}</td>` +
                `<td>${user.full_name}</td>` +
                `<td>${user.email}</td>` +
                `<td>${user.phone}</td>` +
                `<td>${user.gender}</td>` +
                `<td>
                     <a href="#"
                       data-bs-toggle="modal"
                       data-bs-target="#exampleModal"
                       data-id=${user.id}
                       data-full_name=${user.full_name}
                       data-email=${user.email}
                       data-username=${user.username}
                       data-phone=${user.phone}
                        data-gender=${user.gender}
                        >Edit</a>
                </td>
                <td>
                     <form action="controllers/Users.php" method="POST">
                          <input type="hidden" name="type" value="delete"/>
                          <input type="hidden" name="id" value=${user.gender}
                           <button onclick="return confirm('Are you sure you want to delete this user?')"
                                 id="deleteButton" type="submit"><i class="fas fa-trash" id="trashIcon"></i>
                           </button>
                     </form>
                 </td>
             </tr>`
        })
        document.getElementById("data").innerHTML = '';
        document.getElementById("data").innerHTML = output;
    });
}