@extends('vendor.backpack.crud.list')

@section('content')
<!-- Default box -->
  <div class="row">

    <!-- THE ACTUAL CONTENT -->
    <div class="col-md-12">
      <div class="box">
        <div class="box-header {{ $crud->hasAccess('create')?'with-border':'' }}">

          @include('crud::inc.button_stack', ['stack' => 'top'])

          <div id="datatable_button_stack" class="pull-right text-right"></div>
        </div>

        <div class="box-body table-responsive">

        {{-- Backpack List Filters --}}
        @if ($crud->filtersEnabled())
          @include('crud::inc.filters_navbar')
        @endif

        <table id="crudTable" class="table table-bordered table-striped display">
            <thead>
              <tr>
                @if ($crud->details_row)
                  <th data-orderable="false"></th> <!-- expand/minimize button column -->
                @endif

                {{-- Table columns --}}
                @foreach ($crud->columns as $column)
                  <th>{{ $column['label'] }}</th>
                @endforeach

                @if ( $crud->buttons->where('stack', 'line')->count() )
                  <th>{{ trans('backpack::crud.actions') }}</th>
                @endif
              </tr>
            </thead>
            <tbody>

              @if (!$crud->ajaxTable())
                @foreach ($entries as $k => $entry)
                <tr data-entry-id="{{ $entry->getKey() }}">

                  @if ($crud->details_row)
                    @include('crud::columns.details_row_button')
                  @endif

                  {{-- load the view from the application if it exists, otherwise load the one in the package --}}
                  @foreach ($crud->columns as $column)
                    @if (!isset($column['type']))
                      @include('crud::columns.text')
                    @else
                      @if(view()->exists('vendor.backpack.crud.columns.'.$column['type']))
                        @include('vendor.backpack.crud.columns.'.$column['type'])
                      @else
                        @if(view()->exists('crud::columns.'.$column['type']))
                          @include('crud::columns.'.$column['type'])
                        @else
                          @include('crud::columns.text')
                        @endif
                      @endif
                    @endif

                  @endforeach

                  @if ($crud->buttons->where('stack', 'line')->count())
                    <td>
                      @include('crud::inc.button_stack', ['stack' => 'line'])
                    </td>
                  @endif

                </tr>
                @endforeach
              @endif

            </tbody>
            <tfoot>
              <tr>
                @if ($crud->details_row)
                  <th></th> <!-- expand/minimize button column -->
                @endif

                {{-- Table columns --}}
                @foreach ($crud->columns as $column)
                  <th>{{ $column['label'] }}</th>
                @endforeach

                @if ( $crud->buttons->where('stack', 'line')->count() )
                  <th>{{ trans('backpack::crud.actions') }}</th>
                @endif
              </tr>
            </tfoot>
          </table>

        </div><!-- /.box-body -->

        @include('crud::inc.button_stack', ['stack' => 'bottom'])

      </div><!-- /.box -->
    </div>

  </div>

@endsection