@extends('layouts.userindex')


@section('titletext')
	Hinimo
@endsection

@section('title')
	Login
@endsection


@section('content')

<div class="page">
<section id="home" style="height: 200px; background-image: url('silk1.jpg');  background-size:cover; ">
</section>
<div class="container-fluid">
<br><br><br>


<!-- =====================logout================ -->
<div class="row col-md-11 no-gutters" style="text-align: right;">
	<form>
		<input type="submit" name="btn_logout" value="Logout" class="btn btn-default">
	</form>
	<br>
</div>


<!-- ================commands============ -->
<div class="row col-md-11 no-gutters" style="text-align: right;">
	<input type="submit" name="" value="Change Email" class="btn btn-default">

	<input type="submit" name="" value="Update Password" class="btn btn-default">

</div>

<br><br><br><br><br>

<div class="row col-md-10 col-md-offset-1 animate-box services colorlib-heading">
	<h2>My Account</h2>
	<p>Nikki Mosqueda</p>
	<p>Email: nikkimoda@ymail.com</p>


          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Simple Full Width Table</h3>

              <div class="box-tools">
                <ul class="pagination pagination-sm no-margin pull-right">
                  <li><a href="#">&laquo;</a></li>
                  <li><a href="#">1</a></li>
                  <li><a href="#">2</a></li>
                  <li><a href="#">3</a></li>
                  <li><a href="#">&raquo;</a></li>
                </ul>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <table class="table">
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Task</th>
                  <th>Progress</th>
                  <th style="width: 40px">Label</th>
                </tr>
                <tr>
                  <td>1.</td>
                  <td>Update software</td>
                  <td>
                    <div class="progress progress-xs">
                      <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                    </div>
                  </td>
                  <td><span class="badge bg-red">55%</span></td>
                </tr>
                <tr>
                  <td>2.</td>
                  <td>Clean database</td>
                  <td>
                    <div class="progress progress-xs">
                      <div class="progress-bar progress-bar-yellow" style="width: 70%"></div>
                    </div>
                  </td>
                  <td><span class="badge bg-yellow">70%</span></td>
                </tr>
                <tr>
                  <td>3.</td>
                  <td>Cron job running</td>
                  <td>
                    <div class="progress progress-xs progress-striped active">
                      <div class="progress-bar progress-bar-primary" style="width: 30%"></div>
                    </div>
                  </td>
                  <td><span class="badge bg-light-blue">30%</span></td>
                </tr>
                <tr>
                  <td>4.</td>
                  <td>Fix and squish bugs</td>
                  <td>
                    <div class="progress progress-xs progress-striped active">
                      <div class="progress-bar progress-bar-success" style="width: 90%"></div>
                    </div>
                  </td>
                  <td><span class="badge bg-green">90%</span></td>
                </tr>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

         


</div> <!-- class="row col-md-10 col-md-offset-1 -->
</div> <!-- class="container-fluid" -->
</div> <!-- page -->



@endsection