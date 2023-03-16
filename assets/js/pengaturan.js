'use strict';

document.addEventListener('DOMContentLoaded', function (e) {
  (function () {
    const formAccSettings = document.querySelector('#formAccountSettings'),
      formPWC = document.querySelector('#formPWC');

    if (formAccSettings) {
      const fv = FormValidation.formValidation(formAccSettings, {
        fields: {
          nama: { validators: { notEmpty: { message: 'Silahkan masukkan nama.' } } },
          nomer: { validators: { notEmpty: { message: 'Silahkan masukkan Nomer.' } } },
          alamat: { validators: { notEmpty: { message: 'Silahkan masukkan Alamat.' } } },
        },
        plugins: {
          trigger: new FormValidation.plugins.Trigger(),
          bootstrap5: new FormValidation.plugins.Bootstrap5({
            eleValidClass: '',
            rowSelector: '.col-md-6'
          }),
          submitButton: new FormValidation.plugins.SubmitButton(),
          // Submit the form when all fields are valid
          // defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
          autoFocus: new FormValidation.plugins.AutoFocus()
        },
        init: instance => {
          instance.on('plugins.message.placed', function (e) {
            if (e.element.parentElement.classList.contains('input-group')) {
              e.element.parentElement.insertAdjacentElement('afterend', e.messageElement);
            }
          });
        }
      });
      fv.on('core.form.valid', function () {
        const mdat = new FormData($('#formAccountSettings')[0])
        $.ajax({
          data: mdat,
          type: "POST",
          url: 'pengaturan',
          cache: false,
          processData: false,
          contentType: false,
          success: function (d) {
            Swal.fire({ title: "Good job!", text: d.msg, icon:"success", customClass:{ confirmButton:"btn btn-primary" }, buttonsStyling: !1 });
          },
          error: function (e) {
            Swal.fire({ title: "Upss!", text: 'Terjadi kesalahan!', icon:"error", customClass:{ confirmButton:"btn btn-primary" }, buttonsStyling: !1 });
          },
        });
      });
    }

    if (formPWC) {
      const fvp = FormValidation.formValidation(formPWC, {
        fields: {
          currentPassword: { validators: { notEmpty: { message: "Harap kata sandi saat ini!" }, stringLength: { min: 8, message: "Password must be more than 8 characters" } } },
          newPassword: { validators: { notEmpty: { message: "Silakan masukkan kata sandi baru!" }, stringLength: { min: 8, message: "Password must be more than 8 characters" } } },
          confirmPassword: {
            validators: {
              notEmpty: { message: "Harap konfirmasi kata sandi baru" },
              identical: {
                compare: function () {
                  return t.querySelector('[name="newPassword"]').value;
                },
                message: "Kata sandi dan konfirmasinya tidak sama",
              },
              stringLength: { min: 8, message: "Kata sandi harus lebih dari 8 karakter" },
            },
          },
        },
        plugins: {
          trigger: new FormValidation.plugins.Trigger(),
          bootstrap5: new FormValidation.plugins.Bootstrap5({ eleValidClass: "", rowSelector: ".col-md-6" }),
          submitButton: new FormValidation.plugins.SubmitButton(),
          autoFocus: new FormValidation.plugins.AutoFocus(),
        },
        init: (e) => {
          e.on("plugins.message.placed", function (e) {
            e.element.parentElement.classList.contains("input-group") && e.element.parentElement.insertAdjacentElement("afterend", e.messageElement);
          });
        },
      });
      fvp.on('core.form.valid', function () {
        $.ajax({
          data: $('#formPWC').serialize(),
          url: 'pengaturan',
          type: "POST",
          success: function (d) {
            Swal.fire({ title: "Good job!", text: d.msg, icon:"success", customClass:{ confirmButton:"btn btn-primary" }, buttonsStyling: !1 });
          },
          error: function (e) {
            Swal.fire({ title: "Upss!", text: 'Terjadi kesalahan!', icon:"error", customClass:{ confirmButton:"btn btn-primary" }, buttonsStyling: !1 });
          },
        });
      });
    }  

    // if (deactivateAcc) {
    //   const fv = FormValidation.formValidation(deactivateAcc, {
    //     fields: {
    //       accountActivation: {
    //         validators: {
    //           notEmpty: {
    //             message: 'Please confirm you want to delete account'
    //           }
    //         }
    //       }
    //     },
    //     plugins: {
    //       trigger: new FormValidation.plugins.Trigger(),
    //       bootstrap5: new FormValidation.plugins.Bootstrap5({
    //         eleValidClass: ''
    //       }),
    //       submitButton: new FormValidation.plugins.SubmitButton(),
    //       fieldStatus: new FormValidation.plugins.FieldStatus({
    //         onStatusChanged: function (areFieldsValid) {
    //           areFieldsValid
    //             ? // Enable the submit button
    //               // so user has a chance to submit the form again
    //               deactivateButton.removeAttribute('disabled')
    //             : // Disable the submit button
    //               deactivateButton.setAttribute('disabled', 'disabled');
    //         }
    //       }),
    //       // Submit the form when all fields are valid
    //       // defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
    //       autoFocus: new FormValidation.plugins.AutoFocus()
    //     },
    //     init: instance => {
    //       instance.on('plugins.message.placed', function (e) {
    //         if (e.element.parentElement.classList.contains('input-group')) {
    //           e.element.parentElement.insertAdjacentElement('afterend', e.messageElement);
    //         }
    //       });
    //     }
    //   });
    // }

    // Deactivate account alert
    // const accountActivation = document.querySelector('#accountActivation');

    // Alert With Functional Confirm Button
    // if (deactivateButton) {
    //   deactivateButton.onclick = function () {
    //     if (accountActivation.checked == true) {
    //       Swal.fire({
    //         text: 'Are you sure you would like to deactivate your account?',
    //         icon: 'warning',
    //         showCancelButton: true,
    //         confirmButtonText: 'Yes',
    //         customClass: {
    //           confirmButton: 'btn btn-primary me-2',
    //           cancelButton: 'btn btn-label-secondary'
    //         },
    //         buttonsStyling: false
    //       }).then(function (result) {
    //         if (result.value) {
    //           Swal.fire({
    //             icon: 'success',
    //             title: 'Deleted!',
    //             text: 'Your file has been deleted.',
    //             customClass: {
    //               confirmButton: 'btn btn-success'
    //             }
    //           });
    //         } else if (result.dismiss === Swal.DismissReason.cancel) {
    //           Swal.fire({
    //             title: 'Cancelled',
    //             text: 'Deactivation Cancelled!!',
    //             icon: 'error',
    //             customClass: {
    //               confirmButton: 'btn btn-success'
    //             }
    //           });
    //         }
    //       });
    //     }
    //   };
    // }

    // Update/reset user image of account page
    let accountUserImage = document.getElementById('uploadedAvatar');
    const fileInput = document.querySelector('.account-file-input'),
      resetFileInput = document.querySelector('.account-image-reset');

    if (accountUserImage) {
      const resetImage = accountUserImage.src;
      fileInput.onchange = () => {
        if (fileInput.files[0]) {
          accountUserImage.src = window.URL.createObjectURL(fileInput.files[0]);
        }
      };
      resetFileInput.onclick = () => {
        fileInput.value = '';
        accountUserImage.src = resetImage;
      };
    }
  })();
});
