<link rel="stylesheet" type="text/css" href="<?= get_theme_file_uri('/assets/fastappointment/jquery.datetimepicker.css') ?>"/>
<?php
    $timeSessions = [];
    $timeSessions[] = [
        'key' => '8-10',
        'name' => '8:00 -> 10:00'
    ];
    $timeSessions[] = [
        'key' => '10-12',
        'name' => '10:00 -> 12:00'
    ];
    $timeSessions[] = [
        'key' => '12-14',
        'name' => '12:00 -> 14:00'
    ];

    $limitSessions = [];
    $timeSessions[0] = 5;   // $timeSessions[timeSessionsId] = 5;
    $timeSessions[1] = 5;
    $timeSessions[2] = 5;


?>
<div class="container">
    <div class="row">
        <div class="col-6 col-sm-6 col-md-6">
            
        </div>
        <div class="col-6 col-sm-6 col-md-6">
            <div id="demo1-1"></div>
        </div>
    <div>
</div>


<button type="button" id="btn-primary-123" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="booking-appointment">
                <form>
                    <div class="form-group">
                        <label for="email">Time:</label>
                        July 14, 2021 at 6:00 am – 8:00 am
                    </div>
                    <div class="form-group">
                        <label for="email">Phone:</label>
                        
                    </div>
                    <div class="form-group">
                        <label for="email">Name:</label>
                    </div>
                    <div class="form-group">
                        <label for="email">Message:</label>
                        July 14, 2021 at 6:00 am – 8:00 am
                    </div>
                    <div class="form-group">
                        <label for="email">Service:</label>
                        <select class="custom-select">
                            <option selected>Open this select menu</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                </form>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>