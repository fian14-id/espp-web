'use strict';

let fv;
document.addEventListener('DOMContentLoaded', function (e) {
  (function () {
    const formAddNewsiswa = document.getElementById('form-tambah-siswa');

    setTimeout(() => {
      const Newsiswa = document.querySelector('.create-new'),
        offCanvasElement = document.querySelector('#tambah-siswa');
      window.offCanvasEl = new bootstrap.Offcanvas(offCanvasElement);

      // To open offCanvas, to add new record
      if (Newsiswa) {
        Newsiswa.addEventListener('click', function () {
          (offCanvasElement.querySelector('#fid').value = ''),
          (offCanvasElement.querySelector('.dt-nisn').value = ''),
            (offCanvasElement.querySelector('.dt-nis').value = ''),
            (offCanvasElement.querySelector('.dt-nama').value = ''),
            (offCanvasElement.querySelector('.dt-kelas').value = '');
            (offCanvasElement.querySelector('.dt-alamat').value = ''),
            (offCanvasElement.querySelector('.dt-nomer').value = ''),
            (offCanvasElement.querySelector('.dt-spp').value = '');
          offCanvasEl.show();
        });
      }
      $('div.head-label').html('<h5 class="card-title mb-0">Daftar siswa</h5>');
    }, 2000);

    // Form validation for Add new record
    fv = FormValidation.formValidation(formAddNewsiswa, {
      fields: {
        nisn: { validators: { notEmpty: { message: 'Bidang NISN wajib di isi!' } } },
        nis: { validators: { notEmpty: { message: 'Bidang NIS wajib di isi!' } } },
        nama: { validators: { notEmpty: { message: 'Bidang Nama wajib di isi!' } } },
        kelas: { validators: { notEmpty: { message: 'Bidang Kelas wajib di isi!' } } },
        alamat: { validators: { notEmpty: { message: 'Bidang Alamat wajib di isi!' } } },
        nomer: { validators: { notEmpty: { message: 'Bidang Nomer Telp wajib di isi!' } } },
        spp: { validators: { notEmpty: { message: 'Bidang Spp wajib di isi!' } } },
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

$(function () {
  var dt_siswa = $('.siswaf'),
    dt_basic;

  if (dt_siswa.length) {
    dt_basic = dt_siswa.DataTable({
      ajax: 'siswa?type=json',
      columns: [
        { data: '' },
        { data: 'nisn' },
        { data: 'nis' },
        { data: 'nama' },
        { data: 'no_telp' },
        { data: 'tahun' },
        { data: 'alamat' },
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
          targets: 3,
          responsivePriority: 1,
          render: function (data, type, full, meta) {
            var $name = full['nama'];
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
              full['nama_kelas'] + ' ' + full['kompetensi_keahlian']
              '</small>' +
              '</div>' +
              '</div>';
            return $row_output;
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
              '<a onclick="edit(`'+ full['nisn'] +'`)" class="btn btn-sm btn-icon item-edit"><i class="text-primary ti ti-pencil"></i></a>' +
              '<a onclick="fdel(`'+ full['nisn'] +'`)" class="btn btn-sm btn-icon item-edit"><i class="text-danger ti ti-trash"></i></a>'
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
          extend: 'collection',
          className: 'btn btn-label-primary dropdown-toggle me-2',
          text: '<i class="ti ti-file-export me-sm-1"></i> <span class="d-none d-sm-inline-block">Export</span>',
          buttons: [
            {
              extend: 'print',
              text: '<i class="ti ti-printer me-1" ></i>Print',
              className: 'dropdown-item',
              exportOptions: {
                columns: [1, 2, 3, 4, 5, 6, 7],
                // prevent avatar to be display
                format: {
                  body: function (inner, coldex, rowdex) {
                    if (inner.length <= 0) return inner;
                    var el = $.parseHTML(inner);
                    var result = '';
                    $.each(el, function (index, item) {
                      if (item.classList !== undefined && item.classList.contains('user-name')) {
                        result = result + item.lastChild.firstChild.textContent;
                      } else if (item.innerText === undefined) {
                        result = result + item.textContent;
                      } else result = result + item.innerText;
                    });
                    return result;
                  }
                }
              },
              customize: function (win) {
                //customize print view for dark
                $(win.document.body)
                  .css('color', config.colors.headingColor)
                  .css('border-color', config.colors.borderColor)
                  .css('background-color', config.colors.bodyBg);
                $(win.document.body)
                  .find('table')
                  .addClass('compact')
                  .css('color', 'inherit')
                  .css('border-color', 'inherit')
                  .css('background-color', 'inherit');
              }
            },
            {
              extend: 'csv',
              text: '<i class="ti ti-file-text me-1" ></i>Csv',
              className: 'dropdown-item',
              exportOptions: {
                columns: [1, 2, 3, 4, 5, 6, 7],
                // prevent avatar to be display
                format: {
                  body: function (inner, coldex, rowdex) {
                    if (inner.length <= 0) return inner;
                    var el = $.parseHTML(inner);
                    var result = '';
                    $.each(el, function (index, item) {
                      if (item.classList !== undefined && item.classList.contains('user-name')) {
                        result = result + item.lastChild.firstChild.textContent;
                      } else if (item.innerText === undefined) {
                        result = result + item.textContent;
                      } else result = result + item.innerText;
                    });
                    return result;
                  }
                }
              }
            },
            {
              extend: 'excel',
              text: '<i class="ti ti-file-spreadsheet me-1"></i>Excel',
              className: 'dropdown-item',
              exportOptions: {
                columns: [1, 2, 3, 4, 5, 6, 7],
                // prevent avatar to be display
                format: {
                  body: function (inner, coldex, rowdex) {
                    if (inner.length <= 0) return inner;
                    var el = $.parseHTML(inner);
                    var result = '';
                    $.each(el, function (index, item) {
                      if (item.classList !== undefined && item.classList.contains('user-name')) {
                        result = result + item.lastChild.firstChild.textContent;
                      } else if (item.innerText === undefined) {
                        result = result + item.textContent;
                      } else result = result + item.innerText;
                    });
                    return result;
                  }
                }
              }
            },
            {
              extend: 'pdf',
              text: '<i class="ti ti-file-description me-1"></i>Pdf',
              className: 'dropdown-item',
              exportOptions: {
                columns: [1, 2, 3, 4, 5, 6, 7],
                // prevent avatar to be display
                format: {
                  body: function (inner, coldex, rowdex) {
                    if (inner.length <= 0) return inner;
                    var el = $.parseHTML(inner);
                    var result = '';
                    $.each(el, function (index, item) {
                      if (item.classList !== undefined && item.classList.contains('user-name')) {
                        result = result + item.lastChild.firstChild.textContent;
                      } else if (item.innerText === undefined) {
                        result = result + item.textContent;
                      } else result = result + item.innerText;
                    });
                    return result;
                  }
                }
              }
            },
            {
              extend: 'copy',
              text: '<i class="ti ti-copy me-1" ></i>Copy',
              className: 'dropdown-item',
              exportOptions: {
                columns: [1, 2, 3, 4, 5, 6, 7],
                // prevent avatar to be display
                format: {
                  body: function (inner, coldex, rowdex) {
                    if (inner.length <= 0) return inner;
                    var el = $.parseHTML(inner);
                    var result = '';
                    $.each(el, function (index, item) {
                      if (item.classList !== undefined && item.classList.contains('user-name')) {
                        result = result + item.lastChild.firstChild.textContent;
                      } else if (item.innerText === undefined) {
                        result = result + item.textContent;
                      } else result = result + item.innerText;
                    });
                    return result;
                  }
                }
              }
            }
          ]
        },
        {
          text: '<i class="ti ti-plus me-sm-1"></i> <span class="d-none d-sm-inline-block">Tambah siswa</span>',
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
              return 'Detail dari ' + data['nama'];
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
      data: $('#form-tambah-siswa').serialize(),
      url: 'siswa',
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
    $.get(`siswa?id=${id}`, function(d) {
      if (d.status == 200) {
        $('#fid').val(d.data.nisn);
        $('.dt-nama').val(d.data.nama);
        $('.dt-nisn').val(d.data.nisn);
        $('.dt-nis').val(d.data.nis);
        $('.dt-kelas').val(d.data.id_kelas);
        $('.dt-alamat').val(d.data.alamat);
        $('.dt-nomer').val(d.data.no_telp);
        $('.dt-spp').val(d.data.id_spp);
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
            url: 'siswa/' + id,
            success: function () {
              dt_basic.ajax.reload();
              Swal.fire({ icon: "success", title: "Deleted!", text: "siswa telah dihapus!", customClass: { confirmButton: "btn btn-success" } });
            },
            error: function (e) {
              Swal.fire({ title: "Upss!", text: 'Terjadi kesalahan!', icon:"error", customClass:{ confirmButton:"btn btn-primary" }, buttonsStyling: !1 });
            },
          });
        } else {
          t.dismiss === Swal.DismissReason.cancel && Swal.fire({ title: "Cancelled", text: "siswa tidak dihapus!", icon: "error", customClass: { confirmButton: "btn btn-success" } });
        }
      });
  }

  setTimeout(() => {
    $('.dataTables_filter .form-control').removeClass('form-control-sm');
    $('.dataTables_length .form-select').removeClass('form-select-sm');
  }, 300);

});
