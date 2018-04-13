class AddText {
    constructor(parentClass, addTextareaButton, addTitleButton, crossDeleteButton) {
        this.parentClass = document.querySelector('.' + parentClass)
        this.addTextarea = document.querySelector('.' + addTextareaButton)
        this.addTitle = document.querySelector('.' + addTitleButton)
        this.deletes = []
        this.parents = []
        this.i = 0
        this.j = 0

        console.log(this.parentClass)

        this.addTextarea.addEventListener('click', () => {
            this.createTextarea(this.parentClass)
        })

        this.addTitle.addEventListener('click', () => {
            this.createTitle(this.parentClass)
        })
        
        // if(typeof(this.deletes) != 'undefined') {
        //     console.log(this.deletes)
        //     for(let i = 0; i < this.deletes.length; i++) {
        //         this.deletes[i].addEventListener('click', () => {
        //             console.log(this.deletes)
        //             deleteText(this.parentClass, i, deleteIcon)
        //         })
        //     }
        // }
        window.addEventListener('click', (event) => {
            for(let i = 0; i < this.deletes.length; i++) {
                if (this.deletes[i].contains(event.target)) {
                    console.log('DISPLAY')
                    // this.parentClass.removeChild(this.elements[i])
                    while (this.parents[i].firstChild) {
                        this.parents[i].removeChild(this.parents[i].firstChild);
                    }
                } 
            }
        })
    }

    createTextarea(parent) {

        const formContainer = document.createElement('div')
        console.log(this.elements)
        parent.appendChild(formContainer)
        const label = document.createElement('label')
        formContainer.appendChild(label)
        label.classList.add('theoryCreation__addParagraph', 'theoryCreation__addParagraphLabel')
        label.setAttribute('for', 'paragraph')
        label.innerHTML ="Type your text"
        this.createCross(formContainer)
        const textarea = document.createElement('textarea')
        
        formContainer.appendChild(textarea)
        textarea.classList.add('theoryCreation__inputText')
        textarea.setAttribute('name', `paragraph${this.i}`)
        textarea.setAttribute('placeholder', 'Add another argument to your theory')
        this.parents.push(formContainer)
        this.i++
    }
    createTitle(parent) {
        const formContainer = document.createElement('div')
        console.log(this.elements)
        parent.appendChild(formContainer)
        const label = document.createElement('label')
        label.classList.add('theoryCreation__addTitle', 'theoryCreation__addTitleLabel')
        label.setAttribute('for', 'title')
        label.innerHTML ="Title"
        this.createCross(formContainer)
        const title = document.createElement('input')
        formContainer.appendChild(label)
        formContainer.appendChild(title)
        title.classList.add('theoryCreation__input')
        title.setAttribute('name', `title${this.j}`)
        title.setAttribute('placeholder', 'Type your new title')
        this.parents.push(formContainer)
        this.j++
    }

    createCross(parent) {
        const cross = document.createElement('span')
        this.deletes.push(cross)
        console.log(this.deletes)
        parent.appendChild(cross)
        cross.classList.add('theoryCreation__deleteCross')
        const img = document.createElement('img')
        cross.appendChild(img)
        img.classList.add('theoryCreation__deleteCrossImg')
        img.setAttribute('src', '../assets/images/icons/cross.png')
    }
    deleteText(parent, i, deleteIcon) {
        const deletedTextareas = document.querySelectorAll('.theoryCreation__addParagraph')
        const deletedInput = document.querySelectorAll('.theoryCreation__inputText')
        parent.removeChild(deletedTextareas[i])
        parent.removeChild(deletedInput[i])
    }

}


const test = new AddText('theoryCreation__addText', 'theoryCreation__addButtonParagraph', 'theoryCreation__addButtonTitle', 'theoryCreation__deleteCross')

