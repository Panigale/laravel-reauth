<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="/favicon.ico">

    <title>Please Re-Auth yourself</title>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
  </head>

  <body>
      <div class="container">
          <div class="row" style="padding-top: 50px;">
              <div class="col-md-8 col-md-offset-2">
                  <div class="panel panel-default">
                      <div class="panel-heading">Re-enter Password</div>
                      <div class="panel-body">

                          <form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/confirm') }}">
                              {!! csrf_field() !!}

                              <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                  <label class="col-md-4 control-label">Password</label>

                                  <div class="col-md-6">
                                      <input type="password" class="form-control" name="password" value="">

                                      @if ($errors->has('password'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('password') }}</strong>
                                          </span>
                                      @endif
                                  </div>
                              </div>

                              <div class="form-group">
                                  <div class="col-md-6 col-md-offset-4">
                                      <button type="submit" class="btn btn-primary">
                                          <i class="fa fa-btn fa-key"></i> Continue
                                      </button>
                                  </div>
                              </div>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </body>
</html>
