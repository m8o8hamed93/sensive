@extends('them.master')
@section('title','register')
@section('content')

@include('them.partials.hero',['title' => 'Add New Blog'])

  <!-- ================ contact section start ================= -->
  <section class="section-margin--small section-margin">
    <div class="container">
      <div class="row">
        <div class="col-12">
          @if (session('status'))
              <div class="alert alert-success">
                {{ session('status') }}
              </div>              
            @endif
          <form class="form-contact contact_form" method="POST" action="{{ route('blogs.store') }}" id="contactForm" novalidate="novalidate" enctype="multipart/form-data">
            @csrf
              <div class="form-group">
                  <input class="form-control border" name="name" id="name" type="text" placeholder="Enter your Blog Title" value="{{ old('name') }}">
                  <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
              <div class="form-group">
                  <input class="form-control border" name="image"  type="file" placeholder="Insert Image" value="{{ old('image') }}">
                  <x-input-error :messages="$errors->get('image')" class="mt-2" />
                </div>
                <div class="form-group">
                  <select class="form-control border" name="category_id" type="text" placeholder="Enter your Blog Title" value="{{ old('category_id') }}">
                    <option value="">Select Category</option>
                    @if (count($categories) > 0)
                    @foreach ($categories as $category)
                    <option value=" {{$category->id}} ">{{ $category->name }}</option>
                    @endforeach
                    @endif
                  </select>
                  <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                </div>
                <div class="form-group">
                  <textarea class="w-100 border" name="description" type="text"
                        placeholder="Enter your Blog Title" rows="6">
                        {{ old('description') }}
                  </textarea>
                  <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>
                <div class="form-group text-center text-md-right mt-3">
                  <button type="submit" class="button button--active button-contactForm">Submit</button>
                </div>
          </form>
        </div>
      </div>
    </div>
  </section>
	<!-- ================ contact section end ================= -->


@endsection