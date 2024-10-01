function userDropdown() {
    const dropdown = document.getElementById('dropdown-user');
    dropdown.classList.toggle('hidden');
  }
  

  window.onclick = function(event) {
    const dropdown = document.getElementById('dropdown-user');
    const button = dropdown.previousElementSibling;
    if (!button.contains(event.target) && !dropdown.contains(event.target)) {
        dropdown.classList.add('hidden');
    }
  }


  //script untuk form comment
  document.querySelectorAll('.allow-comment').forEach(function (element) {
    element.addEventListener('click', function (e) {
        e.preventDefault();

        let commentId = this.getAttribute('data-id');
        console.log('Submitting form for comment ID:', commentId); 
        document.getElementById('allow-form-' + commentId).submit();
    });
});