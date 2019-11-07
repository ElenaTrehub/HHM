
<div  class="col-md-12" style="box-sizing: border-box;">
            <div class="create-personal" style="position: relative;">
                  <div style="width: 100%;" class="create-personal-header">
                        Projects
                  </div>
                  <div class="row">
                        <div class="col-md-2" style="padding: 0;">
                            <div class="project-list">
                                    <?php foreach ($this->projectList as $info) : ?>
                                    <div class="project-calendar" data-id=<?php print htmlentities($info->project->IdProject); ?>>
                                        <input type="hidden" name="idProject" value=<?php print htmlentities($info->project->IdProject); ?>>
                                        <?php print htmlentities($info->project->Number); ?>
                                    </div>
                                    <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="col-md-10" style="padding: 0;">
                                <div class="project-calendar-year">
                                    <?php foreach ($this->calendar as $calendar): ?>
                                            <?php foreach ($calendar->Year as $month): ?>
                                                        
                                                        <?php foreach ($month->MonthDays as $week): ?>
                                                            
                                                                    <?php foreach ($week as $day): ?>
                                                                        <div  class="project-cal-day" data-date=<?php echo ($day->Date) ?> data-weekday=<?php echo ($day->WeekDay) ?> data-today=<?php echo ($day->Today) ?> data-holiday=<?php echo ($day->Holiday) ?>>
                                                                            <div class="year">
                                                                                <?php echo ($month->Year)?>
                                                                            </div >
                                                                            <div class="month">
                                                                                <?php echo ($month->MonthHeader)?>
                                                                            </div >
                                                                            <div class="day">
                                                                                <?php echo ($day->Date . " " . $day->WeekDayName) ?>
                                                                            </div >
                                                                            
                                                                            
                                                                        </div>
                                                                    <?php endforeach?>

                                                        <?php endforeach?>
                                                    
                                            <?php endforeach?>
                                        <?php endforeach?>
                                        <?php foreach ($this->projectList as $info) : ?>
                                            <form action="/HR/EditProject" method="post">
                                                <div class="proj" onclick="this.parentNode.submit()" data-status="<?php print htmlentities($info->project->Status); ?>" data-id=<?php print htmlentities($info->project->IdProject); ?> data-start=<?php echo ($info->project->Start) ?> data-end=<?php echo ($info->project->End) ?>>
                                                        <input type="hidden" name="idProject" value=<?php print htmlentities($info->project->IdProject); ?>>
                                                        <?php print htmlentities($info->project->Title); ?>
                                                </div>
                                            </form>
                                         <?php endforeach; ?>
                                </div>
                            
                  
                        </div>
                                
                        </div>

                        

                  </div>
                  
            </div>
            
</div>





<!-- <?php $counter = 1 ?>
<?php foreach ($this->projectList as $info) : ?>
<div id="container">
    <div class="row employee-card">
        <div class="col-md">
            <div class="employee-main">
                <form action="/HR/EditProject" method="post">
                    <input type="hidden" name="idProject" value=<?php print htmlentities($info->project->IdProject); ?>>
                    <div class="project-name" data-status="<?php print htmlentities($info->project->Status); ?>"
                        onclick="this.parentNode.submit()">
                        <div style="display:inline-block; vertical-align:middle; padding-top:10px;">
                            <div style="font-size: 30px; margin-top:-3px;">
                                <div>
                                    <?php print htmlentities($info->project->Number); ?>
                                </div>
                                
                                <div
                                    style="display:inline-block; position:absolute; top:15px; right:30px; color:#ccc; font-size:11pt">
                                    <?php print htmlentities($counter++); ?>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="project-card">
                <div class="row">
                    <div style="font-size: 20px;">
                        <?php print htmlentities($info->project->Title); ?>
                    </div>
                </div>
                <div class="row">
                <div style="font-size: 12px">
                                    <?php print htmlentities($info->project->Destination); ?>
                                </div>
                </div>
            </div>
            <div class="project-card">
                <div class="row">
                    <div class="col-md-4 bio-title">Project start:</div>
                    <div class="col-md bio-data">
                        <?php print htmlentities($info->project->Start) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 bio-title">Project end:</div>
                    <div class="col-md bio-data">
                        <?php print htmlentities($info->project->End) ?>
                    </div>
                </div>
            </div>

            

            <div class="row" style="margin-left:0px; margin-bottom:15px">
                <div class="col-md-3" style="margin-left: 0px; padding-left:0px;">
                    <button class="deleteProjectButton" data-toggle="modal" data-target="#bucketModalDelete">Test
                        <span class="tooltip-text"> Daten löschen </span></button>
                </div>
            </div> 

        </div>

        <div class="col-md main-personal-data">
            <div class="bio-header">
                DESCRIPTION
            </div>
            <div class="separator-personal"></div>

            <div class="row">
                <div class="col-md bio-data">
                <?php print htmlentities($info->project->Description); ?></div>
            </div>
        </div>

        <div class="col-md main-personal-data">
            <div class="bio-header">
                VORGESETZTER
            </div>
            <div class="separator-work"></div>

            <div class="row">
            <div style="display:inline-block; vertical-align:top; margin-right: 20px">
                            <img class="employee-photo" src=<?php print htmlentities($info->curator->Photo); ?> alt="" />
                        </div>
                        <div style="display:inline-block; vertical-align:middle; padding-top:10px;">
                            <div style="display:inline-block; font-size: 18px; margin-top:-3px;">
                                <div style="display:inline-block">
                                    <?php print htmlentities($info->curator->Name); ?>
                                </div>
                                <div style="display:inline-block">
                                    <?php print htmlentities($info->curator->LastName); ?>
                                </div>
                                <div style="font-size: 12px">
                                    <?php print htmlentities($info->curator->Position); ?>
                                </div>
                            </div>
                        </div>
            </div>
            <div class="row">
                <div class="col-md-4 bio-title">G17 E-Mail:</div>
                    <div class="col-md bio-data">
                        <?php print htmlentities($info->curator->G17_email) ?>
                    </div>
            </div>
            <div class="row">
            <div class="col-md-4 bio-title">G17 Kürzel:</div>
                    <div class="col-md bio-data">
                        <?php print htmlentities($info->curator->G17_initials) ?>
                    </div>
            </div>
            <div class="row">
            <div class="col-md-4 bio-title">HHM E-Mail:</div>
                    <div class="col-md bio-data"><?php print htmlentities($info->curator->HHM_email) ?></div>
            </div>
            <div class="row">
            <div class="col-md-4 bio-title">HHM Kürzel:</div>
                    <div class="col-md bio-data"><?php print htmlentities($info->curator->HHM_initials) ?></div>
            </div>
        </div>

        <div class="col-md main-personal-data">
            <div class="bio-header">
            Kunde
            </div>
            <div class="separator-pass"></div>

            <div class="row">
                <div class="col-md bio-title">Name der Organisation:</div>
                <div class="col-md bio-data"><?php print htmlentities($info->client->Title); ?></div>
            </div>
            <div class="row">
                <div class="col-md bio-title">Kontakt person:</div>
                <div class="col-md bio-data"><?php print htmlentities($info->client->Contact); ?></div>
            </div>
            <div class="row">
                <div class="col-md bio-title">Telefon:</div>
                <div class="col-md bio-data"><?php print htmlentities($info->client->Phone); ?></div>
            </div>
            <div class="row">
                <div class="col-md bio-title">Email:</div>
                <div class="col-md bio-data"><?php print htmlentities($info->client->Email); ?></div>
            </div>
        </div>

        
        
    
    </div>
    <div class="employee-separator"></div>
</div>

<?php endforeach; ?> -->



<div class="modal fade" id="bucketModalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Drücken Sie Ja, um die Löschung zu bestätigen.
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/HR/deleteproject" method="post">
                <div class="modal-body">
                    <input type="hidden" name="idProject" value=<?php print htmlentities($info->project->IdProject); ?>>
                    <button type="submit" class="btn btn-danger">Ja</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Abbrechen</button>
                </div>
                <div class="modal-footer"></div>
            </form>
        </div>
    </div>
</div>

<script src="/HR/js/projectDeleteConfirm.js"></script>
<script src="/HR/js/project-calendar.js"></script>