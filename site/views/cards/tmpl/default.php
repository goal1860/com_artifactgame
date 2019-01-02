<div class="card-list">
    <h1>Artifact Cards
        <small>
            <?php
                foreach ($this->summary['type_list'] as $typeItem) {
                    echo $typeItem->type;
                    echo ": ";
                    echo $typeItem->count;
                    echo "&nbsp;";
                }
                echo " LAST UPDATE: ";
                echo $this->summary['last_update'];

            ?>
            </small>
        </small></h1>
    <div class="row narrow">
        <div class="list col-compact">
            <form>


                <div class="form-row">

                    <div class="col-xs-5 col-md-2 form-group deckForm">
                        <label class="font-weight-bold mt-1">Rarity:</label>
                    </div>

                    <div class="ck-button">
                        <label>
                            <input type="checkbox" value="1" id="Basic" name="rarity[]"
                                   class="form-check-input rarity-card" checked="checked"><span
                                    class="basic">Basic</span>
                        </label>
                    </div>

                    <div class="ck-button">
                        <label>
                            <input type="checkbox" value="2" id="Common" name="rarity[]"
                                   class="form-check-input rarity-card" checked="checked"><span
                                    class="common">Common</span>
                        </label>
                    </div>
                    <div class="ck-button">
                        <label>
                            <input type="checkbox" value="3" id="Uncommon" name="rarity[]"
                                   class="form-check-input rarity-card" checked="checked"><span class="uncommon">Uncommon</span>
                        </label>
                    </div>
                    <div class="ck-button">
                        <label>
                            <input type="checkbox" value="4" id="Rare" name="rarity[]"
                                   class="form-check-input rarity-card" checked="checked"><span class="rare">Rare</span>
                        </label>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-xs-5 col-md-2 form-group deckForm">
                        <label class="font-weight-bold">Color:</label>
                    </div>

                    <div class="ck-button">

                        <label>
                            <input id="red" name="color[]" value="1"
                                   class="form-check-input color-card" checked="checked"
                                   type="checkbox">
                            <span class="red">Red</span>
                        </label>
                    </div>


                    <div class="ck-button">

                        <label>
                            <input id="blue" name="color[]" value="2"
                                   class="form-check-input color-card" checked="checked"
                                   type="checkbox">
                            <span class="blue">Blue</span>
                        </label>
                    </div>


                    <div class="ck-button">

                        <label>
                            <input id="black" name="color[]" value="3"
                                   class="form-check-input color-card" checked="checked"
                                   type="checkbox">
                            <span class="black">Black</span>
                        </label>
                    </div>


                    <div class="ck-button">

                        <label>
                            <input id="green" name="color[]" value="4"
                                   class="form-check-input color-card" checked="checked"
                                   type="checkbox">
                            <span class="green">Green</span>
                        </label>
                    </div>


                    <div class="ck-button">

                        <label>
                            <input id="nocolor" name="color[]" value="5"
                                   class="form-check-input color-card" checked="checked"
                                   type="checkbox">
                            <span class="nocolor">Item</span>
                        </label>
                    </div>


                </div>
                <div class="form-row">
                    <div class="col-xs-5 col-md-2 form-group deckForm">
                        <label class="font-weight-bold">Type:</label>
                    </div>

                    <div class="ck-button">

                        <label>
                            <input id="Hero" name="type[]" value="1"
                                   class="form-check-input type-card" checked="checked"
                                   type="checkbox">
                            <span class="type"><img src="/images/icons/Hero.png" class="icon" title="Hero">Hero</span>
                        </label>
                    </div>


                    <div class="ck-button">

                        <label>
                            <input id="Spell" name="color[]" value="2"
                                   class="form-check-input type-card" checked="checked"
                                   type="checkbox">
                            <span class="type"><img src="/images/icons/Spell.png" class="icon" title="Spell">Spell</span>
                        </label>
                    </div>


                    <div class="ck-button">

                        <label>
                            <input id="Creep" name="color[]" value="3"
                                   class="form-check-input type-card" checked="checked"
                                   type="checkbox">
                            <span class="type"><img src="/images/icons/Creep.png" class="icon" title="Creep">Creep</span>
                        </label>
                    </div>


                    <div class="ck-button">

                        <label>
                            <input id="Improvement" name="color[]" value="4"
                                   class="form-check-input type-card" checked="checked"
                                   type="checkbox">
                            <span class="type"><img src="/images/icons/Improvement.png" class="icon" title="Improvement">Improve.</span>
                        </label>
                    </div>


                    <div class="ck-button">

                        <label>
                            <input id="Weapon" name="color[]" value="5"
                                   class="form-check-input type-card" checked="checked"
                                   type="checkbox">
                            <span class="type"><img src="/images/icons/Weapon.png" class="icon" title="Weapon">Weapon</span>
                        </label>
                    </div>
                    <div class="ck-button">
                        <label>
                            <input id="Armor" name="color[]" value="6"
                                   class="form-check-input type-card" checked="checked"
                                   type="checkbox">
                            <span class="type"><img src="/images/icons/Armor.png" class="icon" title="Armor">Armor</span>
                        </label>
                    </div>
                    <div class="ck-button">
                        <label>
                            <input id="Accessory" name="color[]" value="7"
                                   class="form-check-input type-card" checked="checked"
                                   type="checkbox">
                            <span class="type"><img src="/images/icons/Accessory.png" class="icon" title="Accessory">Accessory</span>
                        </label>
                    </div>
                    <div class="ck-button">
                        <label>
                            <input id="Consumable" name="color[]" value="8"
                                   class="form-check-input type-card" checked="checked"
                                   type="checkbox">
                            <span class="type"><img src="/images/icons/Consumable.png" class="icon" title="Consumable">Consumable</span>
                        </label>
                    </div>
                </div>
        </div>


    </div>

    </form>
    <div class="table-responsive">
        <table id="cardlist" class="table cardlist">
            <thead>
            <tr>
                <th width="100px">&nbsp;</th>
                <th>Name</th>
                <th>Type</th>

                <th>Color</th>
                <th>Rarity</th>
                <th>Information</th>
                <th>SearchType</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($this->items as $item):

                ?>
                <tr class="row-<?php echo $item->color; ?>">
                    <td><img src="/images/cards/<?php echo $item->miniImgUrl; ?>" class="cardimage"
                             title="<?php echo $item->name; ?>"/>
                        <img src="images/icons/<?php echo $item->subtype === "" ? $item->type : $item->subtype; ?>.png"
                             class="icon"
                             title="<?php echo $attr->subtype === "" ? $item->type : $item->subtype; ?>"/></td>
                    <td><a href="<?php echo $item->link; ?>"><?php echo $item->name; ?></a></td>
                    <td><?php echo $item->type; ?></td>
                    <td><?php echo $item->color === '' ? '-' : utf8_ucwords($item->color); ?></td>
                    <td><?php echo utf8_ucwords($item->rarity); ?></td>
                    <td class="cardinfo"><?php
                        echo $item->information;
                        ?></td>

                    <td>
                        <?php echo $item->subtype === '' ? $item->type : $item->subtype; ?></td>
                    </td>

                </tr>
                <?php
            endforeach;
            ?>
            </tbody>
        </table>
    </div>
</div>
</div>
</div>