<div class="form-group row">
    <label class="col-4 col-form-label">
        <a href="/dashboard/applications/datatables/generals/create" target="_blank" class="text-danger font-weight-bold"><u> Table General </u></a>
    </label>
    <div class="col-8">
        <select name="id_table_general" id="id_table_general" class="form-control" required>
            @if(!empty($data?->id_table_general)) <option value="{{ $data->id_table_general }}" selected> {{ $data->application_table_general->name ?? 'Selected Table' }} </option> @endif
        </select>
        @error('id_table_general') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror
    </div>
</div>

<div class="form-group row">
    <label class="col-4 col-form-label"> Description </label>
    <div class="col-8">
        {{ Html::textarea('description', (isset($data->description) ? $data->description : ''))->class([ $errors->has('description') ? 'form-control is-invalid' : 'form-control', ])->id('ex-textarea') }}
        @error('description') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror
    </div>
</div>

@push('js')
<script>
    $('#id_table_general').select2({
        placeholder: '- Select Table General -',
        ajax: {
            url: '{{ $url }}/data-search',
            dataType: 'json',
            delay: 250,
            data: params => ({
                q: params.term
            }),
            processResults: data => ({
                results: data
            }),
            cache: true
        },
        minimumInputLength: 2
    });
</script>
@endpush