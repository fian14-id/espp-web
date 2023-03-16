'use strict';

const formPetugas = document.querySelector('#formAuthenticationPetugas');
const formSiswa = document.querySelector('#formAuthenticationSiswa');

document.addEventListener('DOMContentLoaded', function (e) {
  (function () {
    if (formPetugas) {
      const fv = FormValidation.formValidation(formPetugas, {
        fields: {
          username: {
            validators: {
              notEmpty: { message: 'Silakan masukkan nama pengguna!' },
              stringLength: { min: 6, message: 'Nama pengguna harus lebih dari 6 karakter!' }
            }
          },
          password: {
            validators: {
              notEmpty: { message: 'Silakan masukkan kata sandi Anda!' },
              stringLength: { min: 6, message: 'Kata sandi harus lebih dari 6 karakter!' }
            }
          }
        },
        plugins: {
          trigger: new FormValidation.plugins.Trigger(),
          bootstrap5: new FormValidation.plugins.Bootstrap5({
            eleValidClass: '',
            rowSelector: '.mb-3'
          }),
          submitButton: new FormValidation.plugins.SubmitButton(),
        //   defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
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
          $.ajax({
            data: $('#formAuthenticationPetugas').serialize(),
            url: 'login',
            type: "POST",
            success: function (d) {
              if (d.status == 200){ 
                  Swal.fire({ title: "Good job!", text: d.msg, icon:"success", customClass:{ confirmButton:"btn btn-primary" }, buttonsStyling: !1 })
                  .then(() => location.href = '/');
              } else Swal.fire({ title: "Upss!", text: d.msg, icon:"error", customClass:{ confirmButton:"btn btn-primary" }, buttonsStyling: !1 });
            },
            error: function (e) {
              Swal.fire({ title: "Upss!", text: 'Terjadi kesalahan!', icon:"error", customClass:{ confirmButton:"btn btn-primary" }, buttonsStyling: !1 });
            },
          });
      });
    }
    if (formSiswa) {
      const fv2 = FormValidation.formValidation(formSiswa, {
        fields: {
          nisn: {
            validators: {
              notEmpty: { message: 'Silakan masukkan NISN anda!' },
              stringLength: { max: 10, message: 'NISN tidak boleh lebih dari 10 angka!' }
            }
          },
          nis: {
            validators: {
              notEmpty: { message: 'Silakan masukkan NIS anda!' },
              stringLength: { max: 8, message: 'NIS tidak boleh lebih dari 8 karakter!' }
            }
          }
        },
        plugins: {
          trigger: new FormValidation.plugins.Trigger(),
          bootstrap5: new FormValidation.plugins.Bootstrap5({
            eleValidClass: '',
            rowSelector: '.mb-3'
          }),
          submitButton: new FormValidation.plugins.SubmitButton(),
        //   defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
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
      fv2.on('core.form.valid', function () {
          $.ajax({
            data: $('#formAuthenticationSiswa').serialize(),
            url: 'login',
            type: "POST",
            success: function (d) {
              if (d.status == 200){ 
                  Swal.fire({ title: "Good job!", text: d.msg, icon:"success", customClass:{ confirmButton:"btn btn-primary" }, buttonsStyling: !1 })
                  .then(() => location.href = '/');
              } else Swal.fire({ title: "Upss!", text: d.msg, icon:"error", customClass:{ confirmButton:"btn btn-primary" }, buttonsStyling: !1 });
            },
            error: function (e) {
              Swal.fire({ title: "Upss!", text: 'Terjadi kesalahan!', icon:"error", customClass:{ confirmButton:"btn btn-primary" }, buttonsStyling: !1 });
            },
          });
      });
    }
  })();
});
