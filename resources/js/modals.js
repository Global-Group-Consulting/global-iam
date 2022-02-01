window.addEventListener("DOMContentLoaded", function () {
  const deleteModal = document.getElementById("deleteModal");
  const refreshAppSecretsModal = document.getElementById("refreshAppSecrets");
  
  if (deleteModal) {
    deleteModal.addEventListener('show.bs.modal', function (event) {
      // Button that triggered the modal
      const button = event.relatedTarget
      
      // Extract info from data-bs-* attributes
      const id = button.dataset.bsId
      const form = this.querySelector('form')
      
      if (!form.originalAction) {
        form.originalAction = form.action
      }
      
      form.action = form.originalAction.replace("_id", id)
    })
  }
  
  if (refreshAppSecretsModal) {
    refreshAppSecretsModal.addEventListener('show.bs.modal', function (event) {
      // Button that triggered the modal
      const button = event.relatedTarget
      
      // Extract info from data-bs-* attributes
      const code = button.dataset.bsCode
      const form = this.querySelector('form')
      
      if (!form.originalAction) {
        form.originalAction = form.action
      }
      
      form.action = form.originalAction.replace("_code", code)
    })
  }
  
})
