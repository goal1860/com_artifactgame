<header class="container-fluid bg-light mb-3">
    <div>

        <div class="form-row">
            <div class="col-md-2">
                <button id="deckBuilderSave" type="submit"
                        class="ag-btn btn-primary btn-block">Save Deck
                </button>
            </div>
            <div class="col-md-2">
                <button id="deckBuilderReset" type="reset" class="ag-btn btn-danger btn-block">
                    Reset Deck
                </button>
            </div>
            <?php if (!$this->loggedIn){ ?>
                <div class="form-row text-danger">
                    Please <a href="<?php echo JRoute::_('index.php?option=com_users&view=login', false); ?>">sign in</a> before save a deck.
                </div>
            <?php } ?>
        </div>
    </div>
</header>
<input type="hidden" value="<?php echo $this->deckCode; ?>" id="deckId">
<div class="row">
    <div class="col-xs-12 col-md-6 mb-3 mb-xl-2 col-compact">
        <div class="card border-secondary mb-1">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link active show" id="tDeck" data-toggle="tab" href="#tabDeck">Deck</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tHeroes" data-toggle="tab" href="#tabHeroes">Heroes
                            <span class="text-muted small deckBuilderHeroCounter"><span class="no-of-heroes">0</span>/<span class="total-heroes">0</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tSpells" data-toggle="tab" href="#tabSpells">Spells
                            <span class="text-muted small deckBuilderSpellCounter"><span class="no-of-spells">0</span>/<span class="total-spells">0</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tItems" data-toggle="tab" href="#tabItems">Items
                            <span class="text-muted small deckBuilderItemCounter"><span class="no-of-items">0</span>/<span class="total-items">0</span>
                        </a>
                    </li>

                </ul>
            </div>
            <div id="deckBuilderTabs" class="tab-content">
                <div id="tabDeck" class="tab-pane active fade in">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <form id="deckBuilderSubmit">
                                    <div class="form-group">
                                        <label for="deckBuilderRules"
                                               class="form-label font-weight-bold mt-1">Format</label>
                                        <select class="form-control" id="deckBuilderRules" name="ruleset">
                                            <option value="1" data-value="1" data-herocards="5" data-spellcards="35"
                                                    data-itemcards="9" selected="selected">Unconfirmed Ruleset (5
                                                Heroes, 35 Spells , 9 Items)
                                            </option>
                                            <option value="2" data-value="2" data-herocards="5" data-spellcards="40+"
                                                    data-itemcards="9+">Unconfirmed Ruleset 2 (5 Heroes, 40+ Spells , 9+
                                                Items)
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="deckName" class="font-weight-bold mt-1">Deck Name</label>
                                        <input class="form-control" id="deckName" name="name" pattern=".{4,}"
                                               maxlength="150" required=""
                                               title="Name should have atleast 4 characters." type="text">
                                    </div>
                                    <div class="form-group">
                                        <label for="deckDesc" class="font-weight-bold mt-1">Description</label>
                                        <textarea class="form-control" id="deckDesc" rows="4" name="desc" minlength="10"
                                                  required=""></textarea>
                                    </div>


                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="tabHeroes" class="tab-pane fade">
                    <div class="card-body pb-0">
                        <div class="row">
                            <div class="col-12">
                                <form id="deckBuilderHeroSearch">
                                    <input name="subject" value="deckBuilderHero" type="hidden">
                                    <input id="hero" name="type[]" value="hero" class="form-check-input"
                                           checked="checked" type="checkbox" hidden="">


                                    <div class="form-row">
                                        <div class="col-xs-3 col-md-2 form-group deckForm">
                                            <label class="font-weight-bold mt-1">Rarity:</label>
                                        </div>

                                        <div class="col-auto form-group">
                                            <div class="ck-button">

                                                <label for="basic" class="form-check-label">
                                                    <input id="basic" name="rarity[]" value="1"
                                                           class="form-check-input rarity-hero" checked="checked"
                                                           type="checkbox">
                                                    <span class="basic">Basic</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-auto form-group">
                                            <div class="ck-button">

                                                <label for="common" class="form-check-label">
                                                    <input id="common" name="rarity[]" value="2"
                                                           class="form-check-input rarity-hero" checked="checked"
                                                           type="checkbox">
                                                    <span class="common">Common</label>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-auto form-group">
                                            <div class="ck-button">

                                                <label for="uncommon" class="form-check-label">
                                                    <input id="uncommon" name="rarity[]" value="3"
                                                           class="form-check-input rarity-hero" checked="checked"
                                                           type="checkbox">
                                                    <span class="uncommon">Uncommon</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-auto form-group">
                                            <div class="ck-button">

                                                <label for="rare" class="form-check-label">
                                                    <input id="rare" name="rarity[]" value="4"
                                                           class="form-check-input rarity-hero" checked="checked"
                                                           type="checkbox">
                                                    <span class="rare">Rare</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-xs-3 col-md-2 form-group deckForm">
                                            <label class="font-weight-bold">Color:</label>
                                        </div>
                                        <div class="col-auto form-group">
                                            <div class="ck-button">

                                                <label for="black" class="form-check-label">
                                                    <input id="black" name="color[]" value="3"
                                                           class="form-check-input color-hero" checked="checked"
                                                           type="checkbox">
                                                    <span class="black">Black</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-auto form-group">
                                            <div class="ck-button">

                                                <label for="blue" class="form-check-label">
                                                    <input id="blue" name="color[]" value="5"
                                                           class="form-check-input color-hero" checked="checked"
                                                           type="checkbox">
                                                    <span class="blue">Blue</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-auto form-group">
                                            <div class="ck-button">

                                                <label for="green" class="form-check-label">
                                                    <input id="green" name="color[]" value="4"
                                                           class="form-check-input color-hero" checked="checked"
                                                           type="checkbox">
                                                    <span class="green">Green</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-auto form-group">
                                            <div class="ck-button">

                                                <label for="red" class="form-check-label">
                                                    <input id="red" name="color[]" value="2"
                                                           class="form-check-input color-hero" checked="checked"
                                                           type="checkbox">
                                                    <span class="red">Red</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-xs-3 col-md-2 form-group deckForm">
                                            <label class="font-weight-bold">Attack:</label>
                                        </div>
                                        <div class="col">
                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <select id="a_attack_op" name="attack_op" class="form-control">
                                                        <option selected="selected" value="1">=</option>
                                                        <option value="2">&gt;=</option>
                                                        <option value="3">&lt;=</option>
                                                        <option value="4">&gt;</option>
                                                        <option value="5">&lt;</option>
                                                        <option value="6">Between</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col">
                                                    <input id="a_attack_nb" name="attack_nb" class="form-control"
                                                           min="0" type="number">
                                                </div>
                                                <div class="col-1 text-center mt-1 attackBetween hide">
                                                    <span>-</span>
                                                </div>
                                                <div class="form-group col attackBetween hide">
                                                    <input id="a_attack_nb_max" name="attack_nb_max"
                                                           class="form-control" min="0" type="number">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-xs-3 col-md-2 form-group deckForm">
                                            <label class="font-weight-bold">Armor:</label>
                                        </div>
                                        <div class="col">
                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <select id="a_armor_op" name="armor_op" class="form-control">
                                                        <option selected="selected" value="1">=</option>
                                                        <option value="2">&gt;=</option>
                                                        <option value="3">&lt;=</option>
                                                        <option value="4">&gt;</option>
                                                        <option value="5">&lt;</option>
                                                        <option value="6">Between</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col">
                                                    <input id="a_armor_nb" name="armor_nb" class="form-control" min="0"
                                                           type="number">
                                                </div>
                                                <div class="col-1 text-center mt-1 armorBetween hide">
                                                    <span>-</span>
                                                </div>
                                                <div class="form-group col armorBetween hide">
                                                    <input id="a_armor_nb_max" name="armor_nb_max" class="form-control"
                                                           min="0" type="number">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-xs-3 col-md-2 form-group deckForm">
                                            <label class="font-weight-bold">Health:</label>
                                        </div>
                                        <div class="col">
                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <select id="a_health_op" name="health_op" class="form-control">
                                                        <option selected="selected" value="1">=</option>
                                                        <option value="2">&gt;=</option>
                                                        <option value="3">&lt;=</option>
                                                        <option value="4">&gt;</option>
                                                        <option value="5">&lt;</option>
                                                        <option value="6">Between</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col">
                                                    <input id="a_health_nb" name="health_nb" class="form-control"
                                                           min="1" type="number">
                                                </div>
                                                <div class="col-1 text-center mt-1 healthBetween hide">
                                                    <span>-</span>
                                                </div>
                                                <div class="form-group col healthBetween hide">
                                                    <input id="a_health_nb_max" name="health_nb_max"
                                                           class="form-control" min="1" type="number">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div id="deckBuilderHeroResults_wrapper"
                         class="dataTables_wrapper dt-bootstrap4 no-footer">
                        <div class="table-compact">
                            <table id="hero-table"
                                   class="table table-hover table-sm table-bordered dt-responsive nowrap dataTable no-footer dtr-inline"
                                   style="width: 100%;" role="grid" aria-describedby="example_info">
                                <thead>
                                <tr role="row">
                                    <th scope="col" class="sorting_asc" tabindex="0" aria-controls="example"
                                        rowspan="1" colspan="1" style="width: 0px;"
                                        aria-label="Name: activate to sort column descending"
                                        aria-sort="ascending">Name
                                    </th>
                                    <th hidden></th>
                                    <th scope="col" class="sorting" tabindex="0" aria-controls="example"
                                        rowspan="1" colspan="1" style="width: 0px;"
                                        aria-label="Attack: activate to sort column ascending"><i class="ra ra-crossed-swords"></i>
                                    </th>
                                    <th scope="col" class="sorting" tabindex="0" aria-controls="example"
                                        rowspan="1" colspan="1" style="width: 0px;"
                                        aria-label="Armor: activate to sort column ascending"><i class="ra ra-shield">
                                    </th>
                                    <th scope="col" class="sorting" tabindex="0" aria-controls="example"
                                        rowspan="1" colspan="1" style="width: 0px;"
                                        aria-label="Health: activate to sort column ascending"><i class="ra ra-hearts">
                                    </th>
                                    <th scope="col" class="sorting" tabindex="0" aria-controls="example"
                                        rowspan="1" colspan="1" style="width: 0px;"
                                        aria-label="Signature Card: activate to sort column ascending">
                                        Sig. Card
                                    </th>
                                    <th></th>

                                </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $flag = true;
                                    foreach($this->cardlist as $card){
                                    ?>
                                        <tr <?php if ($flag !== false) {?> data-mana="<?php echo $card->sigMana; ?>" data-signature="<?php echo $card->sigCard;?>" data-spell-id="<?php echo $card->sigCardId; ?>" <?php } ?> data-count="1" data-color="<?php echo $card->color;?>" data-id="<?php echo $card->id; ?>" data-name="<?php echo $card->name;?>" role="row" class="odd cursorfinger selectHero row-<?php echo $card->color;?>">
                                            <td data-toggle="tooltip" width="140px";
                                                class="sorting_1" tabindex="0">

                                                <?php echo $card->name;?>
                                            </td>
                                            <td hidden>
                                                <?php
                                                if ($card->color !== NULL) {
                                                    echo $card->color;
                                                } else {
                                                    echo '-';
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($card->attack !== NULL) {
                                                    echo $card->attack;
                                                } else {
                                                    echo '-';
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($card->armor !== NULL) {
                                                    echo $card->armor;
                                                } else {
                                                    echo '-';
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($card->health !== NULL) {
                                                    echo $card->health;
                                                } else {
                                                    echo '-';
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($card->sig !== 'Unknown') {
                                                    echo $card->sigCard;
                                                } else {
                                                    echo '-';
                                                }
                                                ?></td>
                                            <td><?php

                                                    echo $card->rarity;

                                                ?></td>

                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
                <div id="tabSpells" class="tab-pane fade">
                    <div class="card-body pb-0">
                        <div class="row">
                            <div class="col-12">
                                <div id="deckBuilderSpellAlert"
                                     class="alert alert-dismissible alert-danger hoverfinger_s hide">
                                    <button id="deckBuilderSpellAlertClose" class="close" type="button">×</button>
                                    <span id="deckBuilderSpellAlertMessage"></span>
                                </div>
                                <form id="deckBuilderSpellSearch">
                                    <input name="subject" value="deckBuilderSpell" type="hidden">


                                    <div class="form-row">
                                        <div class="col-xs-2 form-group deckForm">
                                            <label class="font-weight-bold mt-1">Rarity:</label>
                                        </div>

                                        <div class="col-auto form-group">
                                            <div class="ck-button">

                                                <label for="s_basic" class="form-check-label">
                                                    <input id="s_basic" name="rarity[]" value="1"
                                                           class="form-check-input rarity-spell" checked="checked"
                                                           type="checkbox">
                                                    <span class="basic">Basic</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-auto form-group">
                                            <div class="ck-button">

                                                <label for="s_common" class="form-check-label">
                                                    <input id="s_common" name="rarity[]" value="2"
                                                           class="form-check-input rarity-spell" checked="checked"
                                                           type="checkbox">
                                                    <span class="common">Common</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-auto form-group">
                                            <div class="ck-button">

                                                <label for="s_uncommon" class="form-check-label">
                                                    <input id="s_uncommon" name="rarity[]" value="3"
                                                           class="form-check-input rarity-spell" checked="checked"
                                                           type="checkbox">
                                                    <span class="uncommon">Uncommon</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-auto form-group">
                                            <div class="ck-button">

                                                <label for="s_rare" class="form-check-label">
                                                    <input id="s_rare" name="rarity[]" value="4"
                                                           class="form-check-input rarity-spell" checked="checked"
                                                           type="checkbox">
                                                    <span class="rare">Rare</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-xs-2 form-group deckForm">
                                            <label for="name" class="font-weight-bold">Color:</label>
                                        </div>
                                        <div class="col-auto form-group">
                                            <div class="ck-button">

                                                <label for="a_black" class="form-check-label">
                                                    <input id="a_black" name="color[]" value="3"
                                                           class="form-check-input color-spell" checked="checked"
                                                           type="checkbox">
                                                    <span class="black">Black</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-auto form-group">
                                            <div class="ck-button">

                                                <label for="a_blue" class="form-check-label">
                                                    <input id="a_blue" name="color[]" value="5"
                                                           class="form-check-input color-spell" checked="checked"
                                                           type="checkbox">
                                                    <span class="blue">Blue</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-auto form-group">
                                            <div class="ck-button">

                                                <label for="a_green" class="form-check-label">
                                                    <input id="a_green" name="color[]" value="4"
                                                           class="form-check-input color-spell" checked="checked"
                                                           type="checkbox">
                                                    <span class="green">Green</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-auto form-group">
                                            <div class="ck-button">

                                                <label for="a_red" class="form-check-label">
                                                    <input id="a_red" name="color[]" value="2"
                                                           class="form-check-input color-spell" checked="checked"
                                                           type="checkbox">
                                                    <span class="red">Red</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="col-xs-3 form-group deckForm">
                                            <label for="name" class="font-weight-bold mt-1">Mana Costs:</label>
                                        </div>
                                        <div class="col">
                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <select id="a_mana_op" name="mana_op" class="form-control">
                                                        <option selected="selected" value="1">=</option>
                                                        <option value="2">&gt;=</option>
                                                        <option value="3">&lt;=</option>
                                                        <option value="4">&gt;</option>
                                                        <option value="5">&lt;</option>
                                                        <option value="6">Between</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col">
                                                    <input id="a_mana_nb" name="mana_nb" class="form-control" min="0"
                                                           type="number">
                                                </div>
                                                <div class="col-1 text-center mt-1 manaBetween hide">
                                                    <span>-</span>
                                                </div>
                                                <div class="form-group col manaBetween hide">
                                                    <input id="a_mana_nb_max" name="mana_nb_max" class="form-control"
                                                           min="0" type="number">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                        <div class="mb-3 mx-2">
                            <div id="example1_wrapper"
                                 class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">

                                <div class="row">
                                    <div class="col-sm-12">
                                        <small>* Signature cards (in grey) are automatically in deck when its hero is selected.</small>
                                        <table id="spell-table"
                                               class="table table-hover table-sm table-bordered dt-responsive nowrap dataTable no-footer dtr-inline"
                                               style="width: 100%;" role="grid" aria-describedby="example1_info">
                                            <thead>
                                            <tr role="row">
                                                <th scope="col" class="sorting_asc" tabindex="0"
                                                    aria-controls="example1" rowspan="1" colspan="1" style="width: 0px;"
                                                    aria-label="Name: activate to sort column descending" width="70%"
                                                    aria-sort="ascending">Name
                                                </th>
                                                <th scope="col" class="sorting" tabindex="0" aria-controls="example1"
                                                    rowspan="1" colspan="1" style="width: 0px;"
                                                    aria-label="Color: activate to sort column ascending" width="15%">
                                                    Color
                                                </th>
                                                <th scope="col" class="sorting" tabindex="0" aria-controls="example1"
                                                    rowspan="1" colspan="1" style="width: 0px;"
                                                    aria-label="Mana: activate to sort column ascending" width="15%">
                                                    Mana
                                                </th>
                                                <th scope="col" class="sorting" tabindex="0" aria-controls="example1"
                                                    rowspan="1" colspan="1" style="width: 0px;"
                                                    aria-label="Effect: activate to sort column ascending" hidden="">
                                                    Effect
                                                </th>
                                                <th hidden="" class="sorting" tabindex="0" aria-controls="example1"
                                                    rowspan="1" colspan="1" style="width: 0px;"
                                                    aria-label=": activate to sort column ascending"></th>
                                            </tr>
                                            </thead>
                                            <tbody>


                                            <?php


                                            foreach ($this->spelllist as $spell) {


                                                ?>
                                                <tr data-id="<?php echo $spell->id; ?>" data-count="3"
                                                    data-color="<?php echo $spell->color ?>"
                                                    data-name="<?php echo $spell->name; ?>"
                                                    data-mana="<?php echo $spell->mana; ?>" role="row"
                                                    class="<?php echo $spell->sigOf === "" ? 'cursorfinger selectSpell row-' . $spell->color : ""; ?> ">
                                                    <td data-order="<?php echo $spell->name; ?>" data-toggle="tooltip"
                                                        class="sorting_1" tabindex="0">
                                                        <div class="tooltipwrap">
                                                            <div title="<?php echo str_replace("\"", "'", $spell->effect); ?>" data-html="true" rel="tooltip" href="#"><?php echo $spell->name; ?></div>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <?php echo $spell->color; ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        echo $spell->mana;
                                                        ?>
                                                    </td>
                                                    <td hidden>
                                                        <?php

                                                            echo $spell->effect;

                                                        ?></td>
                                                    <td hidden><?php echo $spell->rarity; ?></td>
                                                </tr>
                                                <?php
                                            }

                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div id="tabItems" class="tab-pane fade">
                    <div class="card-body pb-0">
                        <div class="row">
                            <div class="col-12">
                                <div id="deckBuilderItemAlert"
                                     class="alert alert-dismissible alert-danger hoverfinger_s hide">
                                    <button id="deckBuilderItemAlertClose" class="close" type="button">×</button>
                                    <span id="deckBuilderItemAlertMessage"></span>
                                </div>
                                <form id="deckBuilderItemSearch">
                                    <input name="subject" value="deckBuilderItem" type="hidden">


                                    <div class="form-row">
                                        <div class="col-xs-2 form-group deckForm">
                                            <label class="font-weight-bold mt-1">Rarity:</label>
                                        </div>

                                        <div class="col-auto form-group">
                                            <div class="ck-button">

                                                <label for="i_basic" class="form-check-label">
                                                    <input id="i_basic" name="rarity[]" value="1"
                                                           class="form-check-input rarity-item" checked="checked"
                                                           type="checkbox">
                                                    <span class="basic">Basic</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-auto form-group">
                                            <div class="ck-button">

                                                <label for="i_common" class="form-check-label">
                                                    <input id="i_common" name="rarity[]" value="2"
                                                           class="form-check-input rarity-item" checked="checked"
                                                           type="checkbox">
                                                    <span class="common">Common</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-auto form-group">
                                            <div class="ck-button">

                                                <label for="i_uncommon" class="form-check-label">
                                                    <input id="i_uncommon" name="rarity[]" value="3"
                                                           class="form-check-input rarity-item" checked="checked"
                                                           type="checkbox">
                                                    <span class="uncommon">Uncommon</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-auto form-group">
                                            <div class="ck-button">

                                                <label for="i_rare" class="form-check-label">
                                                    <input id="i_rare" name="rarity[]" value="4"
                                                           class="form-check-input rarity-item" checked="checked"
                                                           type="checkbox">
                                                    <span class="rare">Rare</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="col-xs-2 form-group deckForm">
                                            <label for="name" class="font-weight-bold mt-1">Gold Cost</label>
                                        </div>
                                        <div class="col">
                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <select id="a_gold_op" name="gold_op" class="form-control">
                                                        <option selected="selected" value="1">=</option>
                                                        <option value="2">&gt;=</option>
                                                        <option value="3">&lt;=</option>
                                                        <option value="4">&gt;</option>
                                                        <option value="5">&lt;</option>
                                                        <option value="6">Between</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col">
                                                    <input id="a_gold_nb" name="gold_nb" class="form-control" min="0"
                                                           type="number">
                                                </div>
                                                <div class="col-1 text-center mt-1 goldBetween hide">
                                                    <span>-</span>
                                                </div>
                                                <div class="form-group col goldBetween hide">
                                                    <input id="a_gold_nb_max" name="gold_nb_max" class="form-control"
                                                           min="0" type="number">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                        <div class="mb-3 mx-2">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="item-table"
                                               class="table table-hover table-sm table-bordered dt-responsive nowrap dataTable no-footer dtr-inline" style="width:100%">
                                            <thead>
                                            <tr role="row">
                                                <th scope="col" class="sorting_asc" tabindex="0" rowspan="1" colspan="1" style="width: 0px;"
                                                    aria-label="Name: activate to sort column descending"
                                                    aria-sort="ascending">Name
                                                </th>
                                                <th scope="col" class="sorting" tabindex="0"
                                                    rowspan="1" colspan="1" style="width: 0px;"
                                                    aria-label="Gold: activate to sort column ascending" >
                                                    Gold
                                                </th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>


                                            <?php


                                            foreach ($this->itemlist as $item) {

                                                ?>
                                                <tr data-id="<?php echo $item->id; ?>" data-count="3"
                                                    data-name="<?php echo $item->name; ?>"
                                                    data-gold="<?php echo $item->gold; ?>" role="row"
                                                    class="odd cursorfinger selectItem row-">
                                                    <td data-order="<?php echo $item->name; ?>"
                                                        data-toggle="tooltip"
                                                        class="sorting_1" tabindex="0">
                                                        <div class="tooltipwrap">
                                                            <div title="<?php echo str_replace("\"", "'", $item->effect); ?>" data-html="true" rel="tooltip" href="#"><?php echo $item->name; ?></div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        echo $item->gold;
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                             echo $item->rarity;
                                                        ?>
                                                    </td>
                                                </tr>
                                                <?php  } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>


                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="col-xs-12 col-md-3 col-xl-3 mb-3 mb-xl-0 col-compact">
        <div class="card border-secondary">
            <div class="card-header">
                Deck Cards
            </div>
            <div class="card-body">
          <span class="font-weight-bold">Heroes -
            <span class="deckBuilderHeroCounter"><span class="no-of-heroes">0</span>/<span class="total-heroes">0</span>
          </span>
          <ul class="list-group my-2 deckBuilderHeroList">
            <li class="list-group-item d-flex justify-content-center align-items-center p-1 noselect">-</li>

          </ul>
          <span class="font-weight-bold">Spells -
            <span class="deckBuilderSpellCounter"><span class="no-of-spells">0</span>/<span
                        class="total-spells">0</span>&nbsp;<small>(Sig. cards not included.)</small>
          </span>
          <ul class="list-group my-2 deckBuilderSpellList">
            <li class="list-group-item d-flex justify-content-center align-items-center p-1 noselect">-</li>
          </ul>
          <span class="font-weight-bold">Items -
            <span class="deckBuilderItemCounter"><span class="no-of-items">0</span>/<span class="total-items">0</span>
          </span>
          <ul class="list-group mt-2 deckBuilderItemList">
            <li class="list-group-item d-flex justify-content-center align-items-center p-1 noselect">-</li>
          </ul>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-md-3 col-xl-3 mb-3 mb-xl-0 col-compact">
        <div class="card border-secondary">
            <div class="card-header">
                Deck Stats
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="chartjs-size-monitor"
                             style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                            <div class="chartjs-size-monitor-expand"
                                 style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                            </div>
                            <div class="chartjs-size-monitor-shrink"
                                 style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                            </div>
                        </div>
                        <div style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"
                             class="chartjs-size-monitor">
                            <div class="chartjs-size-monitor-expand"
                                 style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                            </div>
                            <div class="chartjs-size-monitor-shrink"
                                 style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                            </div>
                        </div>
                        <canvas id="heroChart" height="177" style="display: block; height: 177px; width: 356px;"
                                width="356" class="chartjs-render-monitor"></canvas>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="chartjs-size-monitor"
                             style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                            <div class="chartjs-size-monitor-expand"
                                 style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                            </div>
                            <div class="chartjs-size-monitor-shrink"
                                 style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                            </div>
                        </div>
                        <div style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"
                             class="chartjs-size-monitor">
                            <div class="chartjs-size-monitor-expand"
                                 style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                            </div>
                            <div class="chartjs-size-monitor-shrink"
                                 style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                            </div>
                        </div>
                        <canvas id="manaChart" height="177" style="display: block; height: 177px; width: 356px;"
                                width="356" class="chartjs-render-monitor"></canvas>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="chartjs-size-monitor"
                             style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                            <div class="chartjs-size-monitor-expand"
                                 style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                            </div>
                            <div class="chartjs-size-monitor-shrink"
                                 style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                            </div>
                        </div>
                        <div style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"
                             class="chartjs-size-monitor">
                            <div class="chartjs-size-monitor-expand"
                                 style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                            </div>
                            <div class="chartjs-size-monitor-shrink"
                                 style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                            </div>
                        </div>
                        <canvas id="goldChart" height="177" style="display: block; height: 177px; width: 356px;"
                                width="356" class="chartjs-render-monitor"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="components/com_artifactgame/js/builder.js"></script>
<link rel="stylesheet" type="text/css" href="/components/com_artifactgame/css/rpg-awesome.min.css" />