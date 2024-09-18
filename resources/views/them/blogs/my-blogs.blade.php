@extends('them.master')
@section('title','My Blogs')
@section('content')

@include('them.partials.hero',['title' => 'My Blogs'])

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
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">Title</th>
                <th scope="col" width = "5%">Edit</th>
                <th scope="col" width = "5%">Delete</th>
              </tr>
            </thead>
            <tbody>
              @if (count($blogs) > 0)
              @foreach ($blogs as $blog)
              <tr>
                <td>
                  <a href="{{ route('blogs.show',['blog' => $blog]) }}" target="_blank">{{ $blog->name }}</a>
                </td>
                <td>
                  <a href="{{ route('blogs.edit',['blog' => $blog]) }}" class="btn btn-sm btn-primary mr-2">Edit</a>
                </td>
                <td>
                  <form action="{{ route('blogs.destroy',['blog'=>$blog]) }}" method="POST" id="delete_form">
                    @csrf
                    @method('delete')
                    <a href="javascript:$('form#delete_form').submit();" class="nav-link btn btn-sm btn-danger">Delete</a>
                  </form>
                </td>
              </tr>
              @endforeach
              @endif
            </tbody>
          </table>
          @if (count($blogs) > 0)
          {{ $blogs->render('pagination::bootstrap-4') }}
          @endif
        </div>
      </div>
    </div>
  </section>
	<!-- ================ contact section end ================= -->


@endsection