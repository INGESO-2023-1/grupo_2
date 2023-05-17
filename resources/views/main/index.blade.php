@extends('main.template.main')

@section('content')

<x-base.layout.container>
  <div class="col-span-12">

    <x-base.card header="Ingresar">
      <x-base.form
        method="POST"
        action="/login"
        id="form-login"
      >
        <x-base.form.list.item input="text" attribute="username" required />
        <x-base.action type="submit" body="Ingresar" form="form-login"/>
      </x-base.form>
    </x-base.card>
  </div>
</x-base.layout.container>

@endsection
