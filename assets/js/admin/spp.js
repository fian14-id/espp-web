'use strict';

let fv;
document.addEventListener('DOMContentLoaded', function (e) {
  (function () {
    const formAddNewspp = document.getElementById('form-tambah-spp');

    setTimeout(() => {
      const Newspp = document.querySelector('.create-new'),
        offCanvasElement = document.querySelector('#tambah-spp');
      window.offCanvasEl = new bootstrap.Offcanvas(offCanvasElement);

      if (Newspp) {
        Newspp.addEventListener('click', function () {
          (offCanvasElement.querySelector('#fid').value = ''),
          (offCanvasElement.querySelector('.dt-tahun').value = ''),
          (offCanvasElement.querySelector('.dt-nominal').value = '');
          offCanvasEl.show();
        });
      }
      $('div.head-label').html('<h5 class="card-title mb-0">Daftar SPP</h5>');
    }, 2000);

    // Form validation for Add new record
    fv = FormValidation.formValidation(formAddNewspp, {
      fields: {
        tahun: { validators: { notEmpty: { message: 'Bidang Tahun wajib di isi!' } } },
        nominal: { validators: { notEmpty: { message: 'Bidang Nominal wajib di isi!' } } },
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
  var dt_spp = $('.sppf'),
    dt_basic;

  if (dt_spp.length) {
    dt_basic = dt_spp.DataTable({
      ajax: 'spp?type=json',
      columns: [
        { data: 'id_spp' },
        { data: 'tahun' },
        { data: 'nominal' },
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
          responsivePriority: 1,
          targets: 2,
          render: function (data, type, full, meta) {
            return `<span class="badge rounded-pill bg-label-info">${toR(full['nominal'])}</span>`;
          }
        },
        {
          // Actions
          targets: -1,
          title: 'Aksi',
          orderable: false,
          searchable: false,
          render: function (data, type, full, meta) {
            return (
              '<a onclick="edit(`'+ full['id_spp'] +'`)" class="btn btn-sm btn-icon item-edit"><i class="text-primary ti ti-pencil"></i></a>' +
              '<a onclick="fdel(`'+ full['id_spp'] +'`)" class="btn btn-sm btn-icon item-edit"><i class="text-danger ti ti-trash"></i></a>'
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
          text: '<i class="ti ti-plus me-sm-1"></i> <span class="d-none d-sm-inline-block">Tambah spp</span>',
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
              return 'Detail dari ' + data['nama_spp'];
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

  function toR(n){
    return 'Rp ' + String(n).replace(/(.)(?=(\d{3})+$)/g,'$1.')
  }

  fv.on('core.form.valid', function () {
    $.ajax({
      data: $('#form-tambah-spp').serialize(),
      url: 'spp',
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
    $.get(`spp?id=${id}`, function(d) {
      if (d.status == 200) {
        $('#fid').val(d.data.id_spp);
        $('.dt-tahun').val(d.data.tahun);
        $('.dt-nominal').val(d.data.nominal);
        offCanvasEl.show();
      }
    })
  }

  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  window.fdel = (id) => {
    Swal.fire({ title: "Apa kamu yakin?", text: "Anda tidak akan dapat mengembalikan ini!", icon: "warning", showCancelButton: !0, confirmButtonText: "Ya, hapus!", customClass: { confirmButton: "btn btn-primary me-3", cancelButton: "btn btn-label-secondary" }, buttonsStyling: !1, })
      .then(function (t) {
        if(t.value) {
          $.ajax({
            type: "DELETE",
            url: 'spp/' + id,
            success: function () {
              dt_basic.ajax.reload();
              Swal.fire({ icon: "success", title: "Deleted!", text: "spp telah dihapus!", customClass: { confirmButton: "btn btn-success" } });
            },
            error: function (e) {
        Swal.fire({ title: "Upss!", text: 'Terjadi kesalahan!', icon:"error", customClass:{ confirmButton:"btn btn-primary" }, buttonsStyling: !1 });
            },
          });
        } else {
          t.dismiss === Swal.DismissReason.cancel && Swal.fire({ title: "Cancelled", text: "spp tidak dihapus!", icon: "error", customClass: { confirmButton: "btn btn-success" } });
        }
      });
  }

  setTimeout(() => {
    $('.dataTables_filter .form-control').removeClass('form-control-sm');
    $('.dataTables_length .form-select').removeClass('form-select-sm');
  }, 300);
});
