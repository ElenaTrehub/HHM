<div class="create-body2">
    <form action="/HR/updateclient" method="post" enctype="multipart/form-data">
        <div id="personal-details" class="col-md-12">
            <div id="personal-details-header" class="create-personal-header">Kunde Details</div>
            <div class="row">
                <div class="col-md-12">
                    <input type="hidden" name="id" value=<?php echo ($this->clientId); ?>>
                    <div>                                                
                        <div class="bio-description">Kunde name</div>
                            <input type="text" name="Title" class="bio-value"
                                value=<?php if($this->clientId!= ''){echo $this->client->Title;}else{echo '';} ?>>
                    </div>
                    <div>                                                
                        <div class="bio-description">Kunde contact person</div>
                            <input type="text" name="Contact" class="bio-value"
                                value=<?php if($this->clientId!= ''){echo $this->client->Contact;}else{echo '';} ?>>
                    </div>
                    <div class="create-personal-content">
                        <div class="bio-description">Telefon</div>
                            <input type="text" name="Phone" class="bio-value"
                                value=<?php if($this->clientId!= ''){echo $this->client->Phone;}else{echo '';} ?>>
                    </div>
                    <div class="create-personal-content">
                        <div class="bio-description">Email</div>
                            <input type="text" name="Email" class="bio-value"
                                value=<?php if($this->clientId!= ''){echo $this->client->Email;}else{echo '';} ?>>
                    </div>
                    <div>                                                
                        <div class="bio-description">Adresse</div>
                            <input type="text" name="Adresse" class="bio-value"
                                value=<?php if($this->clientId!= ''){echo $this->client->Adress;}else{echo '';} ?>>
                    </div>
                    <div>                                                
                        <div class="bio-description">Vorgesetzter</div>
                            <input type="text" name="Chief" class="bio-value"
                                value=<?php if($this->clientId!= ''){echo $this->client->Chief;}else{echo '';} ?>>
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