console.clear()

function year() {
  const year = document.querySelector('.year')
  const date = new Date()
  if (year) {
    year.innerText = date.getFullYear()
  }
}

year()

async function postData(url = '', data = new FormData()) {
  // Default options are marked with *

  // console.log(data)

  const response = await fetch(url, {
    method: 'POST', // *GET, POST, PUT, DELETE, etc.
    mode: 'cors', // no-cors, *cors, same-origin
    cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
    credentials: 'same-origin', // include, *same-origin, omit

    redirect: 'follow', // manual, *follow, error
    referrerPolicy: 'origin', // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
    body: data, // body data type must match "Content-Type" header
    // body: JSON.stringify(data), // body data type must match "Content-Type" header
  })
  return response.json() // parses JSON response into native JavaScript objects
}

var reqUrl = '/auth/validate'
const regForm = document.querySelector('#register-form')

regForm?.addEventListener('submit', e => {
  e.preventDefault()
  const data = new FormData(e.target)

  postData(reqUrl, data)
    .then(data => {
      data.success ? success(data) : errors(data)
    })
    .catch(error => {
      console.log(error)
    })
})

const success = data => {
  resetErrors()
  modalSuccess()
  console.log('success', data.entity)
  console.log('keys', data.keys)
  console.log('values', data.values)
  console.log('userId', data.userId)
}

const errors = data => {
  resetErrors()
  // console.log('errors', data.errors)
  if (data.errors) {
    const errors = data.errors
    errors.forEach(error => {
      const field = Object.getOwnPropertyNames(error)
      // console.log('field', field)
      const value = error[field]
      // console.log('value', value)
      const inputField = document.querySelector(`[name=${field[0]}]`)

      const div = getNextSibling(inputField, 'div.form-control-feedback')
      // console.log(div)
      div.classList.add('error')
      div.innerText = value
    })
  }
}

const resetErrors = () => {
  const errorDivs = document.querySelectorAll('div.form-control-feedback')
  errorDivs.forEach(div => {
    div.classList.remove('error')
    div.innerHTML = ''
  })
}

const getNextSibling = (elem, selector) => {
  // Get the next sibling element
  let sibling = elem.nextElementSibling

  // If there's no selector, return the first sibling
  if (!selector) return sibling

  // If the sibling matches our selector, use it
  // If not, jump to the next sibling and continue the loop
  while (sibling) {
    if (sibling.matches(selector)) return sibling
    sibling = sibling.nextElementSibling
  }
}

const modalSuccess = () => {
  // Get the modal
  const div = document.createElement('div')
  const modalForm = `
  <div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h2>Success!</h2>
    </div>
    <div class="modal-body">
      <p>You have successfully registered</p>
      <p>and will be redirected to Login page</p>
    </div>
    <div class="modal-footer">
      <h3>or click the link below</h3>
      <a href="/auth/login">Login</a>
    </div>
  </div>

</div>
  `
  div.innerHTML = modalForm
  const wrapper = document.querySelector('.wrapper')
  console.log(wrapper)
  wrapper.appendChild(div)
  const modal = document.getElementById('myModal')

  // Get the button that opens the modal
  // var btn = document.getElementById('myBtn')

  // Get the <span> element that closes the modal
  var span = document.getElementsByClassName('close')[0]

  // When the user clicks the button, open the modal
  // btn.onclick = function () {}
  modal.style.display = 'block'

  // When the user clicks on <span> (x), close the modal
  span.onclick = function () {
    modal.style.display = 'none'
  }

  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function (event) {
    if (event.target == modal) {
      modal.style.display = 'none'
    }
  }
  // setTimeout(() => {
  //   location.href = '/auth/login'
  // }, 3000)
}
