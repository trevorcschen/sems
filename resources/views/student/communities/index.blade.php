@extends('layouts.default')

@section('title', 'Communities')

@section('subheader', 'Communities')
@section('subheader-link', route('communities.index'))

@section('subheader-action', 'List')

@section('pagevendorsstyles')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css"/>
@endsection

@section('content')
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        @if (session('success'))
            <div class="alert alert-success fade show" role="alert">
                <div class="alert-icon"><i class="flaticon2-checkmark"></i></div>
                <div class="alert-text">
                    <strong>
                        Well done!
                    </strong>
                    {!! session('success') !!}
                </div>
                <div class="alert-close">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true"><i class="la la-close"></i></span>
                    </button>
                </div>
            </div>
        @endif
        @if (session('errors'))
            <div class="alert alert-danger fade show" role="alert">
                <div class="alert-icon"><i class="flaticon-warning"></i></div>
                <div class="alert-text">
                    <strong>
                        Whoops!
                    </strong>
                    {!! session('errors') !!}
                </div>
                <div class="alert-close">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true"><i class="la la-close"></i></span>
                    </button>
                </div>
            </div>
        @endif
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-line-chart"></i>
										</span>
                    <h3 class="kt-portlet__head-title">
                        @yield('subheader')
                    </h3>
                </div>
                @can('community.create')
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">
                            <a href="{{ route('communities.create') }}" class="btn btn-brand btn-elevate btn-icon-sm">
                                <i class="la la-plus"></i>
                                New Record
                            </a>
                        </div>
                    </div>
                </div>
                @endcan
            </div>
            <div class="kt-portlet__body">
                <!--begin: Selected Rows Group Action Form -->
                <div class="kt-form kt-form--label-align-right kt-margin-t-20 collapse"
                     id="kt_datatable_group_action_form">
                    <div class="row align-items-center">
                        <div class="col-xl-12">
                            <div class="kt-form__group kt-form__group--inline">
                                <div class="kt-form__label kt-form__label-no-wrap">
                                    <label class="kt-font-bold kt-font-danger-">Selected
                                        <span id="kt_datatable_selected_number">0</span> records:</label>
                                </div>
                                <div class="kt-form__control">
                                    <div class="btn-toolbar">
                                        <button class="btn btn-sm btn-danger" type="button" data-toggle="modal"
                                                data-target="#kt_modal_fetch_id_server">Delete Selected Records
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end: Selected Rows Group Action Form -->
                <table class="table table-striped- table-bordered table-hover table-checkable" id="community_table">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Fee (RM)</th>
                        <th>Max Members</th>
                        <th>Admin</th>
                        <th>Founding Date</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Fee (RM)</th>
                        <th>Max Members</th>
                        <th>Admin</th>
                        <th>Founding Date</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    @can('community.delete')
    <!--begin::Modal-->
    <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete permanently?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <p>The record and all its associated data will deleted.</p>
                </div>
                <div class="modal-footer">
                    <form method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Confirm Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--end::Modal-->

    <!--begin::Modal-->
    <div class="modal fade" id="kt_modal_fetch_id_server" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete permanently?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="kt-scrollable" data-scrollbar-shown="true" data-scrollable="true" data-height="200">
                        <ul class="kt-datatable_selected_ids"></ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <form method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Confirm Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--end::Modal-->
    @endcan
@endsection

@section('pagevendorsscripts')
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
@endsection


@section('pagescripts')
    <script>
        "use strict";
        var KTDatatablesSearchOptionsColumnSearch = function () {

            $.fn.dataTable.Api.register('column().title()', function () {
                return $(this.header()).text().trim();
            });

            var initTable1 = function () {
                var table = $('#community_table').DataTable({
                    responsive: true,
                    dom: "<'row'<'col-sm-12 text-center'B>>\
                    <'row'<'col-sm-12'tr>>\
			        <'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>",
                    searchDelay: 500,
                    processing: true,
                    serverSide: true,
                    buttons: ['copy', 'csv', 'excel'
                        , {
                            extend: 'pdfHtml5',
                            orientation: 'landscape',
                            pageSize: 'A4',
                        }, 'print'],
                    ajax: {
                        url: '{{ route('ajax.public.communities.index') }}',
                        type: "POST",
                        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                    },
                    columns: [
                        {data: 'name', width: '20%'},
                        {data: 'description', width: '30%'},
                        {data: 'fee'},
                        {data: 'max_members', width: '1%'},
                        {data: 'admin'},
                        {data: 'created_at', searchable: 'false', width: '20%'},
                        {data: 'active',  width: '8%'},
                        {data: 'id', responsivePriority: -1, width: '10%'},
                    ],
                    columnDefs: [
                        {
                            targets: -1,
                            title: 'Actions',
                            orderable: false,
                            render: function (data, type, full, meta) {
                                var editURL = '{{ route('communities.edit', ':data') }}';
                                var showURL = '{{ route('communities.show', ':data') }}';
                                editURL = editURL.replace(':data', data);
                                showURL = showURL.replace(':data', data);

                                return '\<a href="' + showURL + '" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="View">\
                                      <i class="la la-search"></i>\
                                    </a>';
                            },
                        },
                        {
                            targets: 1,
                            render: function (data, type, full, meta) {
                                return data.length > 200 ? data.substr(0, 200) +' …' : data;
                            },
                        },
                        {
                            targets: 6,
                            render: function (data, type, full, meta) {
                                var status = {
                                    0: {'title': 'Inactive', 'class': ' kt-badge--danger'},
                                    1: {'title': 'Active', 'class': ' kt-badge--success'},
                                };
                                if (typeof status[data] === 'undefined') {
                                    return data;
                                }
                                return '<span class="kt-badge ' + status[data].class + ' kt-badge--inline kt-badge--pill">' + status[data].title + '</span>';
                            },
                        },
                    ],
                    drawCallback: function () {
                        var thisTable = this;
                        $('.filter').remove();
                        var rowFilter = $('<tr class="filter"></tr>').appendTo($(table.table().header()));

                        this.api().columns().every(function () {
                            var column = this;
                            var input;

                            switch (column.title()) {
                                case 'Name':
                                case 'Description':
                                case 'Fee (RM)':
                                case 'Max Members':
                                case 'Admin':
                                    input = $('<input type="text" class="form-control form-control-sm form-filter kt-input" data-col-index="' + column.index() + '"/>');
                                    break;
                                case 'Founding Date':
                                    input = $('<div class="input-group pull-right" id="kt_daterangepicker_6">\
                                <input type="text" class="form-control form-control-sm kt-input" readonly placeholder="Select date range" data-col-index="' + column.index() + '"/>\
                                    <div class="input-group-append">\
                                    <span class="input-group-text"><i class="la la-calendar-check-o"></i></span>\
                                </div>\
                                </div>');
                                    break;
                                case 'Active':
                                    var status = {
                                        0: {'title': 'Inactive', 'class': ' kt-badge--danger'},
                                        1: {'title': 'Active', 'class': ' kt-badge--success'},
                                    };
                                    input = $('<select class="form-control form-control-sm form-filter kt-input" title="Select" data-col-index="' + column.index() + '">\
										<option value="">Select</option></select>');
                                    column.data().unique().sort().each(function (d, j) {
                                        $(input).append('<option value="' + d + '">' + status[d].title + '</option>');
                                    });
                                    break;
                                case 'Actions':
                                    var search = $('<button class="btn btn-brand kt-btn btn-sm kt-btn--icon">\
                                                  <span>\
                                                    <i class="la la-search"></i>\
                                                    <span>Search</span>\
                                                  </span>\
                                                </button>');

                                    var reset = $('<button class="btn btn-secondary kt-btn btn-sm kt-btn--icon">\
                                                  <span>\
                                                    <i class="la la-close"></i>\
                                                    <span>Reset</span>\
                                                  </span>\
                                                </button>');

                                    $('<th>').append(search).append(reset).appendTo(rowFilter);

                                    $(search).on('click', function (e) {
                                        e.preventDefault();
                                        var params = {};
                                        $(rowFilter).find('.kt-input').each(function () {
                                            var i = $(this).data('col-index');
                                            if (params[i]) {
                                                params[i] += '|' + $(this).val();
                                            } else {
                                                params[i] = $(this).val();
                                            }
                                        });
                                        $.each(params, function (i, val) {
                                            // apply search params to datatable
                                            table.column(i).search(val ? val : '', false, false);
                                        });
                                        table.table().draw();
                                    });

                                    $(reset).on('click', function (e) {
                                        e.preventDefault();
                                        $(rowFilter).find('.kt-input').each(function (i) {
                                            $(this).val('');
                                            table.column($(this).data('col-index')).search('', false, false);
                                        });
                                        table.table().draw();
                                    });
                                    break;
                            }

                            if (column.title() !== 'Actions') {
                                $(input).appendTo($('<th>').appendTo(rowFilter));
                            }
                        });

                        // hide search column for responsive table
                        var hideSearchColumnResponsive = function () {
                            thisTable.api().columns().every(function () {
                                var column = this
                                if (column.responsiveHidden()) {
                                    $(rowFilter).find('th').eq(column.index()).show();
                                } else {
                                    $(rowFilter).find('th').eq(column.index()).hide();
                                }
                            })
                        };

                        // init on datatable load
                        hideSearchColumnResponsive();
                        // recheck on window resize
                        window.onresize = hideSearchColumnResponsive;

                        // predefined ranges
                        var start = moment().subtract(29, 'days');
                        var end = moment();

                        $('#kt_daterangepicker_6').daterangepicker({
                            buttonClasses: ' btn',
                            applyClass: 'btn-primary',
                            cancelClass: 'btn-secondary',

                            startDate: start,
                            endDate: end,
                            ranges: {
                                'Today': [moment(), moment()],
                                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                                'This Month': [moment().startOf('month'), moment().endOf('month')],
                                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                            }
                        }, function(start, end, label) {
                            $('#kt_daterangepicker_6 .form-control').val( start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
                        });
                    },
                });

                table.on('change', '.kt-group-checkable', function () {
                    var set = $(this).closest('table').find('td:first-child .kt-checkable');
                    var checked = $(this).is(':checked');

                    $(set).each(function () {
                        if (checked) {
                            $(this).prop('checked', true);
                            $(this).closest('tr').addClass('active');
                        } else {
                            $(this).prop('checked', false);
                            $(this).closest('tr').removeClass('active');
                        }
                    });
                });

                table.on('change', 'tbody tr .kt-checkbox', function () {
                    $(this).parents('tr').toggleClass('active');
                });

                table.on('change', '.kt-group-checkable, tbody tr .kt-checkbox', function (e) {
                    var checkedNodes = table.rows('.active').nodes();
                    var count = checkedNodes.length;
                    $('#kt_datatable_selected_number').html(count);
                    if (count > 0) {
                        $('#kt_datatable_group_action_form').collapse('show');
                    } else {
                        $('#kt_datatable_group_action_form').collapse('hide');
                    }
                });

                $('#kt_modal_fetch_id_server').on('show.bs.modal', function (e) {
                    var ids = [];
                    $(".kt-checkable:checked").each(function () {
                        ids.push($(this).attr('value'));
                    });
                    var c = document.createDocumentFragment();
                    for (var i = 0; i < ids.length; i++) {
                        var li = document.createElement('li');
                        li.setAttribute('data-id', ids[i]);
                        li.innerHTML = 'Selected record ID: ' + ids[i];
                        c.appendChild(li);
                    }
                    $(e.target).find('.kt-datatable_selected_ids').append(c);

                    var url = '{{ route("communities.destroyMany", ':ids') }}';
                    url = url.replace(':ids', ids);
                    $(this).find('form').attr('action', url);

                }).on('hide.bs.modal', function (e) {
                    $(e.target).find('.kt-datatable_selected_ids').empty();
                });
            };

            return {
                init: function () {
                    initTable1();
                }
            };
        }();

        $(document).ready(function () {
            KTDatatablesSearchOptionsColumnSearch.init();

            @can('community.delete')
            $('#modal-delete').on('show.bs.modal', function (e) {
                var url = '{{ route("communities.destroy", ':id') }}';
                url = url.replace(':id', $(e.relatedTarget).data('id'));
                $(this).find('form').attr('action', url);
            });
            @endcan
        });


    </script>
@endsection
