<!DOCTYPE html>
<html lang="en-US">
<head>
    <title>Laravel Ajax CRUD Example</title>
<meta name="_token" content="{!! csrf_token() !!}"/>
    <!-- Load Bootstrap CSS -->
    <link href="{{asset('bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
</head>
<body>
    <div class="container-narrow">
        <h2>Laravel Ajax Test</h2>
        <button id="btn-add" name="btn-add" class="btn btn-primary btn-xs">Add New City Weather</button>
        <div>

            <!-- Table-to-load-the-data Part -->
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>City Name</th>
                        <th>PinCode</th>
                        <th>CloudCover</th>
                        <th>Humidity</th>
                        <th>Current Temperature</th>
                        <th>Visibility</th>
                        <th>Date Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="tasks-list" name="tasks-list">

                    @foreach ($cities as $city)
                    <tr id="city{{$city->id}}">
                        <td>{{$city->id}}</td>
                        <td>{{$city->cityname}}</td>
                        <td>{{$city->pincode}}</td>
                        <td>{{$city->cloudcover}}</td>
                        <td>{{$city->humidity}}</td>
                        <td>{{$city->temp_C}}</td>
                        <td>{{$city->visibility}}</td>
                        <td>{{$city->created_at}}</td>
                        <td>
                            <button class="btn btn-warning btn-xs btn-detail open-modal" value="{{$city->id}}">Edit</button>
                            <button class="btn btn-danger btn-xs btn-delete delete-task" value="{{$city->id}}">Delete</button>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div id="resultContainer">

            </div>
            <!-- End of Table-to-load-the-data Part -->
            <!-- Modal (Pop up when detail button clicked) -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h4 class="modal-title" id="myModalLabel">Task Editor</h4>
                        </div>
                        <div class="modal-body">
                            <form id="frmTasks" name="frmTasks" class="form-horizontal" novalidate="">

                                <div class="form-group error">
                                    <label for="inputTask" class="col-sm-3 control-label">Name of City</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control has-error" id="cityname" name="cityname" placeholder="Name of City" value="" required="required">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="pincode" class="col-sm-3 control-label">Pincode</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="pincode" name="pincode" placeholder="Pincode" value="" required="required">
                                    </div>
                                </div>
                                 <div class="form-group">
                                 <div class="col-sm-3">

                                 </div>
                                                               <div class="col-sm-9">
                                        <input type="button" class="btn btn-primary" class="form-control" id="getCurrentweather"  value="get Current weather">
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">cloudcover</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="cloudcover" name="cloudcover" placeholder="cloudcover" value="">
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">humidity</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="humidity" name="humidity" placeholder="Humidity" value="">
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Current Temperature</label>
                                    <div class="col-sm-9">
                                       <input type="text" class="form-control" id="temp_C" name="temp_C" placeholder="Current Temperature" value="">
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Visibility</label>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control" id="visibility" name="visibility" placeholder="visibility" value="">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="btn-save" value="add">Save changes</button>
                            <a class="btn" data-dismiss="modal">Close</a>
                            <input type="hidden" id="city_id" name="city_id" value="0">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <meta name="_token" content="{!! csrf_token() !!}" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="{{asset('bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/premiumAPI.js')}}"></script>
    <script src="{{asset('js/ajax-crud.js')}}"></script>
</body>
</html>
