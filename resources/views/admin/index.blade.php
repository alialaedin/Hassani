@extends('admin.layouts.master')

@section('styles')
  <style>
    .card-title { font-weight: bold;}
    .card-header { border: none;}
  </style>
@endsection


@section('content')
  <div class="card">
    <div class="card-header">
      <h2 class="card-title">آپلود فایل اکسل</h2>
    </div>
    <div class="card-body">
      <div class="row">
        <form action="{{ route('upload-file') }}" class="col-12" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" name="excel_file">
                  <label class="custom-file-label">Choose file</label>
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <button class="btn btn-primary btn-block">آپلود</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header">
      <div class="card-title">لیست تمامی فایل ها</div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
				<div class="dataTables_wrapper dt-bootstrap4 no-footer">
          <div class="row">
						<table class="table table-vcenter table-striped text-nowrap text-center table-bordered border-bottom">
							<thead>
							<tr>
								<th class="font-weight-bold">ردیف</th>
								<th>نام فایل</th>
								<th>تاریخ آپلود</th>
								<th>عملیات</th>
							</tr>
							</thead>
							<tbody>
								@forelse ($files as $file)
									<tr>
										<td class="font-weight-bold">{{ $loop->iteration }}</td>
										<td>{{ $file->name }}</td>
										<td>{{ verta($file->created_at) }}</td>
										<td>
                      <button 
                        class="btn btn-sm btn-success" 
                        @disabled($file->is_send)>
                        ارسال
                        <i class="fa fa-send mr-1"></i>
                      </button>
                      <a 
                        href=""
                        class="btn btn-sm btn-primary">
                        دانلود
                        <i class="fa fa-download mr-1"></i>
                      </a>
                    </td>
									</tr>
								@empty
								<tr>
									<td colspan="4">
										<div class="text-center">
											<span class="text-danger">هیچ داده ای یافت نشد !</span>
										</div>
									</td>
								</tr>
								@endforelse
							</tbody>
						</table>
					</div>
				</div>
      </div>
    </div>
  </div>
@endsection
