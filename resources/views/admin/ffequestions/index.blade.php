@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="card">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">{{ __('Questions') }}</h6>
            <div class="ml-auto">
                <a href="{{ route('admin.ffequestions.create') }}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span class="text">{{ __('New Question') }}</span>
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover datatable datatable-question" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th width="10"></th>
                            <th>No</th>
                            <th>Category</th>
                            <th>Question text</th>
                            <th>Compulsory Line 1</th>
                            <th>Compulsory Line 2</th>
                            <th>Optional Line 1</th>
                            <th>Optional Line 2</th>
                            <th>Optional Line 3</th>
                            <th>Error Line</th>
                            <th>Correct Command</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($questions as $question)
                        <tr data-entry-id="{{ $question->id }}">
                            <td></td>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $question->category->name }}</td>
                            <td>{{ $question->question_text }}</td>
                            <td>{{ $question->compulsory_line1 }}</td>
                            <td>{{ $question->compulsory_line2 }}</td>
                            <td>{{ $question->optional_line1 }}</td>
                            <td>{{ $question->optional_line2 }}</td>
                            <td>{{ $question->optional_line3 }}</td>
                            <td>{{ $question->error_line }}</td>
                            <td>{{ $question->correct_command }}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.ffequestions.edit', $question->id) }}" class="btn btn-info">
                                        <i class="fa fa-pencil-alt"></i>
                                    </a>
                                    <form onclick="return confirm('Are you sure?')" class="d-inline" action="{{ route('admin.ffequestions.destroy', $question->id) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger" style="border-top-left-radius: 0;border-bottom-left-radius: 0;">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="12" class="text-center">{{ __('Data Empty') }}</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection

@push('script-alt')
<script>
    $(function () {
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons);
        let deleteButtonTrans = 'delete selected';
        let deleteButton = {
            text: deleteButtonTrans,
            url: "{{ route('admin.ffequestions.mass_destroy') }}",
            className: 'btn-danger',
            action: function (e, dt, node, config) {
                var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
                    return $(entry).data('entry-id');
                });
                if (ids.length === 0) {
                    alert('zero selected');
                    return;
                }
                if (confirm('Are you sure?')) {
                    $.ajax({
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        method: 'POST',
                        url: config.url,
                        data: { ids: ids, _method: 'DELETE' }
                    })
                    .done(function () { location.reload(); });
                }
            }
        };
        dtButtons.push(deleteButton);
        $.extend(true, $.fn.dataTable.defaults, {
            order: [[1, 'asc']],
            pageLength: 50,
        });
        $('.datatable-question:not(.ajaxTable)').DataTable({ buttons: dtButtons });
        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
        });
    });
</script>
@endpush