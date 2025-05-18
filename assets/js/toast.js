document.addEventListener('DOMContentLoaded', function () {
  const toastTrigger = document.getElementById('liveToastBtn');
  const toastLiveExample = document.getElementById('liveToast');

  if (toastTrigger) {
      toastTrigger.addEventListener('click', function () {
          const toast = new bootstrap.Toast(toastLiveExample);
          toast.show();
      });
  }
});