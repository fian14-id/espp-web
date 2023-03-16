'use strict';

let fv;
document.addEventListener('DOMContentLoaded', function (e) {
  (function () {
    const formAddNewPetugas = document.getElementById('form-tambah-petugas');

    setTimeout(() => {
      const NewPetugas = document.querySelector('.create-new'),
        offCanvasElement = document.querySelector('#tambah-petugas');
      window.offCanvasEl = new bootstrap.Offcanvas(offCanvasElement);

      if (NewPetugas) {
        NewPetugas.addEventListener('click', function () {
          (offCanvasElement.querySelector('#fid').value = ''),
          (offCanvasElement.querySelector('.dt-name').value = ''),
          (offCanvasElement.querySelector('.dt-usr').value = ''),
          (offCanvasElement.querySelector('.dt-pass').value = ''),
          (offCanvasElement.querySelector('.dt-level').value = '');
          // Open offCanvas with form
          offCanvasEl.show();
        });
      }
      $('div.head-label').html('<h5 class="card-title mb-0">Daftar Petugas</h5>');
    }, 2000);

    // Form validation for Add new record
    fv = FormValidation.formValidation(formAddNewPetugas, {
      fields: {
        name: { validators: { notEmpty: { message: 'Bidang Nama wajib di isi!' } } },
        usrnm: { validators: {
          notEmpty: { message: 'Bidang Username wajib di isi!' },
          stringLength: { min: 6, message: 'Username harus lebih dari 6 karakter!' }
        } },
        pass: { validators: { 
          notEmpty: { message: 'Bidang Password wajib di isi!' },
          stringLength: { min: 6, message: 'Password harus lebih dari 6 karakter!' }
        } },
        level: { validators: { notEmpty: { message: 'Bidang Level wajib di isi!' } } },
      },
      plugins: {
        trigger: new FormValidation.plugins.Trigger(),
        bootstrap5: new FormValidation.plugins.Bootstrap5({
          // Use this for enabling/changing valid/invalid class
          // eleInvalidClass: '',
          eleValidClass: '',
          rowSelector: '.col-sm-12'
        }),
        submitButton: new FormValidation.plugins.SubmitButton(),
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
  })();
});

// datatable (jquery)
$(function () {
  var dt_petugas = $('.petugasf'),
    dt_basic;

  if (dt_petugas.length) {
    dt_basic = dt_petugas.DataTable({
      ajax: 'petugas?type=json',
      columns: [
        { data: 'id_petugas' },
        { data: 'nama_petugas' },
        { data: 'username' },
        { data: 'password' },
        { data: '' }
      ],
      columnDefs: [
        {
          // For Responsive
          className: 'control',
          orderable: false,
          searchable: false,
          responsivePriority: 2,
          targets: 0,
          render: function (data, type, full, meta) {
            return '';
          }
        },
        {
          targets: 1,
          responsivePriority: 3,
          render: function (data, type, full, meta) {
            var $name = full['nama_petugas'];
            var states = ['success', 'danger', 'warning', 'info', 'primary', 'secondary'];
            var $state = states[Math.floor(Math.random() * 6)],
              $initials = $name.match(/\b\w/g) || [];
              
            var $initials = (($initials.shift() || '') + ($initials.pop() || '')).toUpperCase();
            var $fhs = '<span class="avatar-initial rounded-circle bg-label-' + $state + '">' + $initials + '</span>';
          
            // Creates full output for row
            var $row_output =
              '<div class="d-flex justify-content-start align-items-center user-name">' +
              '<div class="avatar-wrapper">' +
              '<div class="avatar me-2">' +
              $fhs +
              '</div>' +
              '</div>' +
              '<div class="d-flex flex-column">' +
              '<span class="emp_name text-truncate">' +
              $name +
              '</span>' +
              '<small class="emp_post text-truncate text-muted">' +
              full['level'] +
              '</small>' +
              '</div>' +
              '</div>';
            return $row_output;
          }
        },
        {
          responsivePriority: 1,
          targets: 2
        },
        {
          // Actions
          targets: -1,
          title: 'Aksi',
          orderable: false,
          searchable: false,
          render: function (data, type, full, meta) {
            return (
              '<a onclick="edit(`'+ full['id_petugas'] +'`)" class="btn btn-sm btn-icon item-edit"><i class="text-primary ti ti-pencil"></i></a>' +
              '<a onclick="fdel(`'+ full['id_petugas'] +'`)" class="btn btn-sm btn-icon item-edit"><i class="text-danger ti ti-trash"></i></a>'
            );
          }
        }
      ],
      order: [[2, 'desc']],
      dom: '<"card-header flex-column flex-md-row"<"head-label text-center"><"dt-action-buttons text-end pt-3 pt-md-0"B>><"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
      displayLength: 7,
      lengthMenu: [7, 10, 25, 50, 75, 100],
      buttons: [
        {
          text: '<i class="ti ti-plus me-sm-1"></i> <span class="d-none d-sm-inline-block">Tambah Petugas</span>',
          className: 'create-new btn btn-primary'
        }
      ],
      language: {
        url: '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Indonesian.json'
      },
      responsive: {
        details: {
          display: $.fn.dataTable.Responsive.display.modal({
            header: function (row) {
              var data = row.data();
              return 'Detail dari ' + data['nama_petugas'];
            }
          }),
          type: 'column',
          renderer: function (api, rowIdx, columns) {
            var data = $.map(columns, function (col, i) {
              return col.title !== '' // ? Do not show row in modal popup if title is blank (for check box)
                ? '<tr data-dt-row="' +
                    col.rowIndex +
                    '" data-dt-column="' +
                    col.columnIndex +
                    '">' +
                    '<td>' +
                    col.title +
                    ':' +
                    '</td> ' +
                    '<td>' +
                    col.data +
                    '</td>' +
                    '</tr>'
                : '';
            }).join('');

            return data ? $('<table class="table"/><tbody />').append(data) : false;
          }
        }
      }
    });
  }

  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  fv.on('core.form.valid', function () {
    $.ajax({
      data: $('#form-tambah-petugas').serialize(),
      url: 'petugas',
      type: "POST",
      success: function (d) {
        dt_basic.ajax.reload();
        Swal.fire({ title: "Good job!", text: d.msg, icon:"success", customClass:{ confirmButton:"btn btn-primary" }, buttonsStyling: !1 });
        offCanvasEl.hide();
      },
      error: function (e) {
        Swal.fire({ title: "Upss!", text: 'Terjadi kesalahan!', icon:"error", customClass:{ confirmButton:"btn btn-primary" }, buttonsStyling: !1 });
      },
  });
});

  window.edit = (id) => {
    $.get(`petugas?id=${id}`, function(d) {
      if (d.status == 200) {
        $('#fid').val(d.data.id_petugas);
        $('.dt-name').val(d.data.nama_petugas);
        $('.dt-usr').val(d.data.username);
        $('.dt-pass').val(d.data.password);
        $('.dt-level').val(d.data.level);
        offCanvasEl.show();
      }
    })
  }

  window.fdel = (id) => {
    Swal.fire({ title: "Apa kamu yakin?", text: "Anda tidak akan dapat mengembalikan ini!", icon: "warning", showCancelButton: !0, confirmButtonText: "Ya, hapus!", customClass: { confirmButton: "btn btn-primary me-3", cancelButton: "btn btn-label-secondary" }, buttonsStyling: !1, })
      .then(function (t) {
        if(t.value) {
          $.ajax({
            type: "DELETE",
            url: 'petugas/' + id,
            success: function () {
              dt_basic.ajax.reload();
              Swal.fire({ icon: "success", title: "Deleted!", text: "Petugas telah dihapus!", customClass: { confirmButton: "btn btn-success" } });
            },
            error: function (e) {
        Swal.fire({ title: "Upss!", text: 'Terjadi kesalahan!', icon:"error", customClass:{ confirmButton:"btn btn-primary" }, buttonsStyling: !1 });
            },
          });
        } else {
          t.dismiss === Swal.DismissReason.cancel && Swal.fire({ title: "Cancelled", text: "Petugas tidak dihapus!", icon: "error", customClass: { confirmButton: "btn btn-success" } });
        }
      });
  }

  setTimeout(() => {
    $('.dataTables_filter .form-control').removeClass('form-control-sm');
    $('.dataTables_length .form-select').removeClass('form-select-sm');
  }, 300);
});
