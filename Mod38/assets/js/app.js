function year() {
  const year = document.querySelector('.year')
  year.innerText = new Date().getFullYear()
}

year()
