import toastr from 'toastr';
import 'toastr/build/toastr.min.css';

// Initialize Toastr options
toastr.options = {
  closeButton: true,
  progressBar: true,
};

export function useToastr() {
  function showSuccessMessage(message) {
    toastr.success(message);
  }

  function showErrorMessage(message) {
    toastr.error(message);
  }

  return {
    showSuccessMessage,
    showErrorMessage,
  };
}
