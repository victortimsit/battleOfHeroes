class AddText {
    constructor(parentClass, addTextareaButton, addTitleButton, crossDeleteButton) {
        // Set variables
        this.parentClass = document.querySelector('.' + parentClass)
        this.addTextarea = document.querySelector('.' + addTextareaButton)
        this.addTitle = document.querySelector('.' + addTitleButton)

        // Set arrays
        this.deletes = []
        this.parents = []

        // Set counts
        this.i = 1

        // Create textarea
        this.addTextarea.addEventListener('click', () => {
            this.createTextarea(this.parentClass)
        })

        // Create title
        this.addTitle.addEventListener('click', () => {
            this.createTitle(this.parentClass)
        })


        window.addEventListener('click', (event) => {
            for(let i = 0; i < this.deletes.length; i++) {
                if (this.deletes[i].contains(event.target)) {
                    // Delete all childs
                    while (this.parents[i].firstChild) {
                        this.parents[i].removeChild(this.parents[i].firstChild);
                    }
                } 
            }
        })
    }

    createTextarea(parent) {
        // Create form container
        const formContainer = document.createElement('div')
        parent.appendChild(formContainer)

        // Create label
        const label = document.createElement('label')
        formContainer.appendChild(label)

        // Set label
        label.classList.add('theoryCreation__addParagraph', 'theoryCreation__addParagraphLabel')
        label.setAttribute('for', 'paragraph')
        label.innerHTML ="Type your text"

        // Create delete cross
        this.createCross(formContainer)

        // Create textarea
        const textarea = document.createElement('textarea')
        formContainer.appendChild(textarea)

        // Set textarea
        textarea.classList.add('theoryCreation__inputText')
        textarea.setAttribute('name', `content${this.i}`)
        textarea.setAttribute('placeholder', 'Add another argument to your theory')

        // Push form container in parents array
        this.parents.push(formContainer)
        this.i++
    }
    createTitle(parent) {
        const formContainer = document.createElement('div')
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
        title.setAttribute('name', `content${this.i}`)
        title.setAttribute('placeholder', 'Type your new title')

        // Push form container in parents array
        this.parents.push(formContainer)
        this.i++
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
        // Set deleted elements
        const deletedTextareas = document.querySelectorAll('.theoryCreation__addParagraph')
        const deletedInput = document.querySelectorAll('.theoryCreation__inputText')

        // Remove
        parent.removeChild(deletedTextareas[i])
        parent.removeChild(deletedInput[i])
    }

}


const test = new AddText('theoryCreation__addText', 'theoryCreation__addButtonParagraph', 'theoryCreation__addButtonTitle', 'theoryCreation__deleteCross')

