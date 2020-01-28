<div class="modal" id="modal-verant">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">modal-genre-title</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    @method('')
                    @csrf
                    <div class="form-group">
                        <label for="dropdown">Vereniging</label>
                        <select name="dropdown" id="dropdown">
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="naam">Naam</label>
                        <input type="text" name="naam" id="naam"
                               class="form-control"
                               placeholder="Naam"
                               minlength="3"
                               value="">
                        <div class="invalid-feedback"></div>
                    </div>

                    <div class="form-group">
                        <label for="voornaam">Voornaam</label>
                        <input type="text" name="voornaam" id="voornaam"
                               class="form-control"
                               placeholder="Voornaam"
                               minlength="3"
                               value="">
                        <div class="invalid-feedback"></div>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email"
                               class="form-control"
                               placeholder="Email"
                               minlength="3"
                               value="">
                        <div class="invalid-feedback"></div>
                    </div>

                    <div class="form-group">
                        <label for="straat">Straat</label>
                        <input type="text" name="straat" id="straat"
                               class="form-control"
                               placeholder="Straat"
                               minlength="3"
                               required
                               value="">
                        <div class="invalid-feedback"></div>
                    </div>

                    <div class="form-group">
                        <label for="huisnummer">Huisnummer</label>
                        <input type="text" name="huisnummer" id="huisnummer"
                               class="form-control"
                               placeholder="Huisnummer"
                               minlength="3"
                               required
                               value="">
                        <div class="invalid-feedback"></div>
                    </div>

                    <div class="form-group">
                        <label for="postcode">Postcode</label>
                        <input type="text" name="postcode" id="postcode"
                               class="form-control"
                               placeholder="Postcode"
                               minlength="3"
                               required
                               value="">
                        <div class="invalid-feedback"></div>
                    </div>

                    <div class="form-group">
                        <label for="telefoon">Telefoon</label>
                        <input type="text" name="telefoon" id="telefoon"
                               class="form-control"
                               placeholder="Telefoon"
                               minlength="3"
                               required
                               value="">
                        <div class="invalid-feedback"></div>
                    </div>

                    <div class="form-group">
                        <label for="geboortedatum">Geboortedatum</label>
                        <input type="date" name="geboortedatum" id="geboortedatum"
                               class="form-control"
                               placeholder="Geboortedatum"
                               minlength="3"
                               required
                               value="">
                        <div class="invalid-feedback"></div>
                    </div>

                    <button type="submit" class="btn btn-success">Bewaar verantwoordelijke</button>
                </form>
            </div>
        </div>
    </div>
</div>