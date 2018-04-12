// class MarkRatio {
//     constructor() {

//     }
// }

const credibilities = document.querySelectorAll('.theoriesFlow__credibilityBarFill')
const popularities = document.querySelectorAll('.theoriesFlow__popularityBarFill')

for(const element of credibilities) {
    const ratio = element.dataset.credibility
    element.style.width = `${ratio}%`
}

for(const element of popularities) {
    const ratio = element.dataset.popularity
    element.style.width = `${ratio}%`
}
