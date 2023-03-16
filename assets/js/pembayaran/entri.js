'use strict';

const formBayar = document.querySelector('#form-bayar'),
  select2 = $('.select2');
let fv;

document.addEventListener('DOMContentLoaded', function (e) {
  (function () {
    fv = FormValidation.formValidation(formBayar, {
      fields: {
        bulan: { validators: { notEmpty: { message: 'Silakan masukkan Bulan!' } } },
        total: { validators: { notEmpty: { message: 'Silakan masukkan Total Pembayaran!' } } },
      },
      plugins: {
        trigger: new FormValidation.plugins.Trigger(),
        bootstrap5: new FormValidation.plugins.Bootstrap5({
          eleValidClass: '',
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
    
  })();
});

$(function () {
  var dt_entri = $('.entrif'),
    dt_basic;

  if (select2.length) {
    select2.each(function () {
      var $this = $(this);
      $this.wrap('<div class="position-relative"></div>').select2({
        placeholder: 'Select value',
        dropdownParent: $this.parent()
      });
    });
  }

  if (dt_entri.length) {
    dt_basic = dt_entri.DataTable({
      ajax: 'entri?type=json',
      columns: [
        { data: '' },
        { data: 'nisn' },
        { data: 'nama' },
        { data: 'spp_tahun' },
        { data: 'total_bayar' },
        { data: 'total_bayar' },
        { data: 'total_bayar' },
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
          targets: 2,
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
              full['kelas'] +
              '</small>' +
              '</div>' +
              '</div>';
            return $row_output;
          }
        },
        {
          targets: 4,
          orderable: false,
          searchable: false,
          render: function (data, type, full, meta) {
            return toR(full['spp_total']);
          }
        },
        {
          targets: 5,
          orderable: false,
          searchable: false,
          render: function (data, type, full, meta) {
            const ft = full['spp_total'] - full['total_bayar'];
            if (ft == 0) return `<span class="badge rounded-pill bg-label-success">Sudah Lunas</span>`;
            else return `<a onclick="bayar('${full['nisn']}')" class="btn rounded-pill btn-sm btn-label-warning"><span class="ti-xs ti ti-wallet me-1"></span>Bayar</a>`;
          }
        },
        {
          targets: 6,
          orderable: false,
          searchable: false,
          render: function (data, type, full, meta) {
            const ft = full['spp_total'] - full['total_bayar'];
            return toR(ft);
          }
        },
        {
          // Actions
          targets: -1,
          orderable: false,
          searchable: false,
          render: function (data, type, full, meta) {
            return '<a href="history/'+ full['nisn'] +'" class="btn rounded-pill btn-sm btn-label-info"><span class="ti-xs ti ti-history me-1"></span>History</a>';
          }
        }
      ],
      order: [[2, 'desc']],
      dom: '<"card-header flex-column flex-md-row"<"head-label text-center"><"dt-action-buttons text-end pt-3 pt-md-0"B>><"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
      displayLength: 7,
      lengthMenu: [7, 10, 25, 50, 75, 100],
      buttons: [
        // {
        //   text: '<i class="ti ti-plus me-sm-1"></i> <span class="d-none d-sm-inline-block">Tambah entri</span>',
        //   className: 'create-new btn btn-primary'
        // }
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

  fv.on('core.form.valid', function () {
    $.ajax({
      data: $('#form-bayar').serialize(),
      url: 'entriBayar',
      type: "POST",
      success: function (d) {
        dt_basic.ajax.reload();
        Swal.fire({ title: "Good job!", text: d.msg, icon:"success", customClass:{ confirmButton:"btn btn-primary" }, buttonsStyling: !1 });
        $('#modalBayar').modal('hide');
        $('#nsn').val('');
        $('#nma').val('');
        $('#sthn').val('');
        $('#sspp').val('');
        $('#bln').val('');
      },
      error: function (e) {
        Swal.fire({ title: "Upss!", text: 'Terjadi kesalahan!', icon:"error", customClass:{ confirmButton:"btn btn-primary" }, buttonsStyling: !1 });
      },
    })
  });
  
  function toR(n){
    return 'Rp ' + String(n).replace(/(.)(?=(\d{3})+$)/g,'$1.')
  }

  window.bayar = (id) => {
    $.get(`siswa?id=${id}`, function(d) {
      if (d.status == 200) {
        $('#nsn').val(d.data.nisn);
        $('#nma').val(d.data.nama);
        $('#sthn').val(d.data.tahun);
        $('#sspp').val(d.data.id_spp);
        $('#bln').html('');
        d.blnList.forEach(f => {
          $('#bln').append(`<option ${d.blnSelected.includes(f) ? 'disabled' : ''}>${f}</option>`)
        });
        $('#modalBayar').modal('show');
      }
    })
  }

  setTimeout(() => {
    $('div.head-label').html('<h5 class="card-title mb-0">Entri Pembayaran</h5>')
    $('.dataTables_filter .form-control').removeClass('form-control-sm');
    $('.dataTables_length .form-select').removeClass('form-select-sm');
  }, 300);
});
