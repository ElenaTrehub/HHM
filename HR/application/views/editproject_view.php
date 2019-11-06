<div class="create-body2">
    <form action="/HR/updateproject" method="post" enctype="multipart/form-data">
        <div id="personal-details" class="col-md-12">
            <div id="personal-details-header" class="create-personal-header">Project Details</div>
            <div class="row">
                <div class="col-md-12">
                    <input type="hidden" name="id" value=<?php echo ($this->projectId); ?>>
                    <div>                                                
                        <div class="bio-description">Project name</div>
                            <input type="text" name="Title" class="bio-value"
                                value=<?php if($this->projectId!= ''){echo $this->project->Title;}else{echo '';} ?>>
                    </div>
                    <div>                                                
                        <div class="bio-description">Project number</div>
                            <input type="text" name="Number" class="bio-value"
                                value=<?php if($this->projectId!= ''){echo $this->project->Number;}else{echo '';} ?>>
                    </div>
                    <div class="create-personal-content">
                        <div class="bio-description">Project start</div>
                            <input type="date" name="StartDate" class="bio-value"
                                value=<?php if($this->projectId!= ''){echo $this->project->Start;}else{echo '';} ?>>
                    </div>
                    <div class="create-personal-content">
                        <div class="bio-description">Project end</div>
                            <input type="date" name="EndDate" class="bio-value"
                                value=<?php if($this->projectId!= ''){echo $this->project->End;}else{echo '';} ?>>
                    </div>
                    <div>                                                
                        <div class="bio-description">Project standort</div>
                            <input type="text" name="Destination" class="bio-value"
                                value=<?php if($this->projectId!= ''){echo $this->project->Destination;}else{echo '';} ?>>
                    </div>
                    <div>                                                
                        <div class="bio-description">Project beschreibung</div>
                            <input type="text" name="Description" class="bio-value"
                                value=<?php if($this->projectId!= ''){echo $this->project->Description;}else{echo '';} ?>>
                    </div>

                    
                    <div>                       
                        <div class="bio-description">Vorgesetzter</div>
                            <input list="Curators" name="Curator" class="bio-value"
                                value="<?php if($this->projectId!= ''){      
                                        echo $this->project->Curator; 
                                    }else{echo '';} 
                                    ?>">
                            <datalist id="Curators">
                                <?php if(isset($this->curators[0])){
                                    foreach($this->curators as $cur){
                                        print '<option data-value=' . $cur->idCurator . '>' . $cur->Name . " ". $cur->LastName .'</option>';
                                    }
                                } ?>
                            </datalist>
                    </div>
                    
                    <div>
                        <div class="bio-description">Kunde</div>
                            <input list="Clients" name="Client" class="bio-value"
                                value="<?php if($this->projectId!= ''){      
                                    echo $this->project->Client;
                                }else{echo '';} 
                                ?>">
                                <datalist id="Clients">
                                    <?php if (isset($this->clients[0])){
                                        foreach($this->clients as $client){
                                                print "<option data-value='" . $client->idClient . "'>" . $client->Title . "</option>";
                                        }
                                    } ?>
                                </datalist>
                    </div>
                    <div>                       
                        <div class="bio-description">Project status</div>
                            <input list="Statuses" name="Status" class="bio-value"
                                value="<?php if($this->projectId!= ''){      
                                        echo $this->project->Status; 
                                    }else{echo '';} 
                                    ?>">
                            <datalist id="Statuses">
                                <?php if(isset($this->statuses[0])){
                                    foreach($this->statuses as $status){
                                        print '<option data-value=' . $status->idStatusProject . '>' . $status->statusProjectTitle .'</option>';
                                    }
                                } ?>
                            </datalist>
                    </div>
                    <div class="button-container">
                        <input type="submit" id="btn-add" name="SaveButton" class="personal-categories-btn" value="Speichern">
                              <a id="btn-cancel" class="personal-categories-btn" href="/HR/main">Abbrechen</a>
                    </div>
                    
                </div>
            </div>
        </div>
    </form>
</div>