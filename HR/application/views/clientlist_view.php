<?php $counter = 1 ?>
<?php foreach ($this->clientList as $client) : ?>
<div id="container">
    <div class="row employee-card">
        <div class="col-md">
            <div class="employee-main">
                <form action="/HR/EditClient" method="post">
                    <input type="hidden" name="idClient" value=<?php print htmlentities($client->idClient); ?>>
                    <div class="project-name" onclick="this.parentNode.submit()">
                        <div style="display:inline-block; vertical-align:middle; padding-top:10px;">
                            <div style="font-size: 30px; margin-top:-3px;">
                                <div>
                                    <?php print htmlentities($client->Title); ?>
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
                    <div style="font-size: 20px">
                        <?php print htmlentities($client->Adress); ?>
                    </div>
                </div>
            </div>
            

            

            <div class="row" style="margin-left:0px; margin-bottom:15px">
                <div class="col-md-3" style="margin-left: 0px; padding-left:0px;">
                    <button class="deleteClientButton" data-toggle="modal" data-target="#bucketModalDelete">Test
                        <span class="tooltip-text"> Daten löschen </span></button>
                </div>
            </div> 

        </div>

        <div class="col-md main-personal-data">
            <div class="bio-header">
            VORGESETZTER
            </div>
            <div class="separator-personal"></div>

            <div class="row">
                <div class="col-md bio-data">
                <?php print htmlentities($client->Chief); ?></div>
            </div>
        </div>

        <div class="col-md main-personal-data">
            <div class="bio-header">
                KОNTACT PERSON
            </div>
            <div class="separator-work"></div>

            
            <div class="row">
                <div class="col-md-4 bio-title">Name:</div>
                    <div class="col-md bio-data">
                        <?php print htmlentities($client->Contact) ?>
                    </div>
            </div>
            <div class="row">
            <div class="col-md-4 bio-title">Telefon:</div>
                    <div class="col-md bio-data">
                        <?php print htmlentities($client->Phone) ?>
                    </div>
            </div>
            <div class="row">
            <div class="col-md-4 bio-title">E-Mail:</div>
                    <div class="col-md bio-data"><?php print htmlentities($client->Email) ?></div>
            </div>
            
        </div>

        <div class="col-md main-personal-data">
            <div class="bio-header">
            Projects
            </div>
            <div class="separator-pass"></div>
            <?php foreach ($client->Projects as $project) : { ?>
                <div class="row">
                    <div class="col-md bio-data"><?php print htmlentities($project->project->Number); ?></div>
                </div>
            <?php }
            endforeach; ?>
            
        </div>

        
        
    
    </div>
    <div class="employee-separator"></div>
</div>

<?php endforeach; ?>



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
            <form action="/HR/deleteclient" method="post">
                <div class="modal-body">
                    <input type="hidden" name="idClient" value=<?php print htmlentities($client->idClient); ?>>
                    <button type="submit" class="btn btn-danger">Ja</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Abbrechen</button>
                </div>
                <div class="modal-footer"></div>
            </form>
        </div>
    </div>
</div>

<script src="/HR/js/clientDeleteConfirm.js"></script>