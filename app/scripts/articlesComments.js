const commentIcons = document.querySelectorAll('.article__commentsIconContainer')
const commentWindows = document.querySelectorAll('.article__userComments')
console.log(commentIcons)

window.addEventListener('click', (event) => {
for(let i = 0; i < commentIcons.length; i++) {
        if (commentIcons[i].contains(event.target) || commentWindows[i].contains(event.target)) {
            // Clicked in buttonToDisplay
            commentWindows[i].classList.remove('article__userComments--hidden')
            commentWindows[i].classList.add('article__userComments--visible')
        } else {
            // Clicked outside buttonToDisplay and window
            commentWindows[i].classList.remove('article__userComments--visible')  
            commentWindows[i].classList.add('article__userComments--hidden')
        }
    }
})