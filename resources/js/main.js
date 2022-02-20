import axios from "axios";

let valueInput = document.getElementById('value')
let uploadButton = document.getElementById('text-button')
let commentBody = document.getElementById('comment-body')
let loadMoreButton = document.getElementById('load-more')
let searchUsersInput = document.getElementById('login')
let userPage = document.getElementById('users')
let paginate = 2;
let sliderComments = document.getElementById('slider-comments')
let userId = null;
loadMoreButton.addEventListener('click', (e) => {
    e.preventDefault()
    loadComments()
})

const loadComments = () => {
    axios.get(`/comments?page=${paginate}${userId != null ? `&user_id=${userId}` : ''}`).then((response) => {
        if (response.data.data.length !== 0) {
            response.data.data.forEach((value) => {
                commentBody.innerHTML += `<div class="card-body bg-light m-2">
                                    Автор : ${value.user.login} <br> ${value.value}
                                </div>`
            })
            paginate += 1;
        }
    })
}


const sendComment = () => {
    axios.post('/comment', {
        'value': valueInput.value
    }).then((response) => {

        commentBody.innerHTML =
            `
<div class="card-body bg-light m-2">
Автор : ${response.data.user.login} <br> ${response.data.value}
</div>
    ${commentBody.innerHTML}
`

        valueInput.value = ''
    }).catch((e) => console.log(e))

}

if (uploadButton != undefined)
    uploadButton.addEventListener("click", (e) => {
        e.preventDefault()
        sendComment()
    })

function loadCommentsByAuthor(user) {
    userId = user
    searchUsersInput.value = ''
    axios.get(`/comments?page=1&user_id=${userId}`).then((response) => {
        if (response.data.data.length !== 0) {
            userPage.innerHTML = ''
            commentBody.innerHTML = ''
            response.data.data.forEach((value) => {
                commentBody.innerHTML += `<div class="card-body bg-light m-2">
                                    Автор : ${value.user.login} <br> ${value.value}
                                </div>`
            })
        }
    })

}

searchUsersInput.addEventListener("change", (e) => {
    if (e.target.value.length > 2)
        axios.get(
            `/user?login=${e.target.value}`
        ).then((response) => {
            response.data.forEach((user) => {
                userPage.innerHTML = ''
                userPage.innerHTML +=
                    `
                    <div class="card-body bg-info users-select-main" style="cursor: pointer;" data-user="${user.id}">
                        ${user.login}
                    </div>
                    `

            })
            attachClickEvent()

        })
})

function attachClickEvent() {
    let usersItems = document.querySelectorAll('.users-select-main')

    usersItems.forEach((userItem) => {
        userItem.addEventListener('click', (e) => {
            loadCommentsByAuthor(userItem.getAttribute('data-user'))
        })
    })
}

let sliderCommentArray = JSON.parse(sliderComments.getAttribute('data-sliders'))

function renderElements() {
    sliderComments.innerHTML = '';
    [sliderCommentArray[index], sliderCommentArray[secondIndex]].forEach((comment, index) => {
        sliderComments.innerHTML += `
        <div class="card-body bg-light m-2 ">
            Автор : ${comment.user.login} <br> ${comment.value}
        </div>
    `
    })
}

let index = 0
let secondIndex = 1;
renderElements()

let nextButton = document.getElementById('next')
let prevButton = document.getElementById('prev')

nextButton.addEventListener('click', () => {
    if (index < 4)
        index += 1;
    else
        index = 0

    if (secondIndex < 4)
        secondIndex += 1;
    else
        secondIndex = 0

    renderElements()
})


prevButton.addEventListener('click',()=>{
    if (index > 0)
        index -= 1;
    else
        index = 4

    if (secondIndex > 0)
        secondIndex -= 1;
    else
        secondIndex = 4

    renderElements()
})
