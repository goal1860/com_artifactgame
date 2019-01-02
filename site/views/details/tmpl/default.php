<header class="container-fluid bg-light mb-3">
    <div>
        <h1 class="h4 py-2 mb-0  float-left"><?php echo $this->deck->name; ?></h1>

        <a id="likeButton" data-deckid="<?php echo $this->deck->hash; ?>" type="button" class="ag-button btn-primary float-right">
            <i class="fa fa-thumbs-up"></i> Upvote
            (<span id="likeCounter"><?php echo $this->upvotes; ?></span>)
        </a>
        <?php if($this->editable){?>
        <a id="editButton" data-deckid="<?php echo $this->deck->hash; ?>" type="button" class="ag-button btn-primary float-right" href="/deck-builder?id=<?php echo $this->deck->hash; ?>">
            <i class="fa fa-edit"></i> Edit

        </a>
            <?php if($this->deck->published){?>
                <a id="publish" data-status="1" data-deckid="<?php echo $this->deck->hash; ?>" type="button" class="ag-button btn-danger float-right" ">
                    Unpublish

                </a>
            <?php } else {?>
                <a id="publish" data-status="1" data-deckid="<?php echo $this->deck->hash; ?>" type="button" class="ag-button btn-success float-right" ">
                     Publish

                </a>
            <?php }?>
        <?php }?>
    </div>
</header>

<div class="row">
    <div class="col-xs-12 col-md-8 mb-3 mb-xl-2">
        <div class="card border-secondary">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" id="tOverview" data-toggle="tab" href="#overview">Overview</a>
                    </li>

                </ul>
            </div>
            <div id="deckViewTabs" class="tab-content">
                <div id="overview" class="tab-pane active show">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-6 mt-3 mt-md-0 order-2 order-md-1">
                                <div>
                                    <span class="font-weight-bold">Format: <?php echo $this->deck->format; ?></span>
                                </div>

                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 col-md-6">
                                              <span class="font-weight-bold">Heroes -
                          <span class="deckViewerHeroCounter">
                            5                          </span>
                        </span>
                                <ul class="list-group my-2 deckViewerHeroList">

                                    <?php

                                    foreach ($this->heroes as $hero) {?>
                                        <li class="list-group-item p-1" data-id="<?php echo $hero->id;?>" data-amount="1" data-name="<?php echo $hero->title;?>" data-color="<?php echo $hero->color;?>">
                            <span class="d-flex align-items-center">
                              <span class="mx-2">1×</span>
                              <span class="badge badge-pill mr-2 cardcolor-<?php echo $hero->color;?> hero-<?php echo $hero->color;?>">.</span>
                                <?php echo $hero->title;?>
                            </span>
                                        </li>
                                        <?php
                                    } ?>
                                </ul>
                                <span class="font-weight-bold">Items -
                          <span class="deckViewerItemCounter"><?php echo count($this->items); ?></span>
                        </span>
                                <ul class="list-group mt-2 deckViewerItemList">
                                    <?php
                                    foreach ($this->itemLines as $itemLine) {?>
                                        <li class="list-group-item p-1" data-id="<?php echo $itemLine->id;?>" data-amount="<?php echo $itemLine->count;?>" data-costs="<?php echo explode(' ', $itemLine->cost)[0];?>" data-name="<?php echo $itemLine->name; ?>">
                              <span class="d-flex align-items-center">
                                <span class="mx-2"><?php echo $itemLine->count;?>×</span>
                                <div class="badge-item-width">
                                  <span class="badge badge-warning badge-pill mr-2"><?php echo explode(' ', $itemLine->cost)[0];?></span>
                                </div>
                                  <?php echo $itemLine->name; ?>
                              </span>
                                        </li>
                                        <?php
                                    }?>
                                </ul>
                            </div>
                            <div class="col-12 col-md-6 mt-2 mt-md-0">
                      <span class="font-weight-bold">
                        Spells -
                        <span class="deckViewerSpellCounter"><?php echo count($this->spells); ?></span>
                      </span>
                                <ul class="list-group my-2 deckViewerSpellList">
                                    <?php
                                    foreach ($this->spellLines as $spellLine) {?>
                                        <li class="list-group-item p-1" data-id="<?php echo $spellLine->id;?>" data-amount="<?php echo $spellLine->count;?>" data-costs="<?php echo explode(' ', $spellLine->cost)[0];?>" data-name="<?php echo $spellLine->name;?>" data-color="<?php echo $spellLine->color;?>">
                          <span class="d-flex align-items-center">
                            <span class="mx-2"><?php echo $spellLine->count;?>×</span>
                            <span class="badge badge-pill mr-2 cardcolor-<?php echo $spellLine->color; ?>"><?php echo explode(' ', $spellLine->cost)[0];?></span>
                              <?php echo $spellLine->name;?>
                          </span>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <div>
                                    <span class="font-weight-bold">Description</span>
                                </div>
                                <?php echo $this->deck->description; ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="col-xs-12 col-md-4 col-xl-4 mb-3 mb-xl-0">
        <div class="card border-secondary">
            <div class="card-header">
                Deck Stats
            </div>
            <div class="card-body p-1">
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
                        <canvas id="heroChart" height="169" style="display: block; height: 169px; width: 340px;"
                                width="340" class="chartjs-render-monitor"></canvas>
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
                        <canvas id="manaChart" height="169" style="display: block; height: 169px; width: 340px;"
                                width="340" class="chartjs-render-monitor"></canvas>
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
                        <canvas id="goldChart" height="169" style="display: block; height: 169px; width: 340px;"
                                width="340" class="chartjs-render-monitor"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="components/com_artifactgame/js/custom-chart.js"></script>
<script>
    let arr = $('.deckViewerItemList').find('li').toArray();
    const selectedItems = [];
    let maxGold = 0;
    arr.forEach((element) => {
        let gold = parseInt(element.dataset.costs);
    let count = parseInt(element.dataset.amount);
    selectedItems.push({
        gold: gold,
        count: count
    });
    if (gold !== '-')
        maxGold = maxGold < gold ? gold : maxGold;
    });
    for(let i=0;i<=maxGold; ++i) {
        goldChart.data.labels.push(i);
        goldChart.data.datasets[0].data[i] = 0;
    }
    selectedItems.forEach(function (item, index) {
        goldChart.data.datasets[0].data[item.gold] += item.count;
    });
    goldChart.update();

    arr = $('.deckViewerHeroList').find('li').toArray();
    heroChart.data.datasets[1].data = [0, 0, 0, 0];
    arr.forEach((hero) => {
        if (hero.dataset.color === 'red') {
        heroChart.data.datasets[1].data[3]++;
    } else if (hero.dataset.color === 'black') {
        heroChart.data.datasets[1].data[0]++;
    } else if (hero.dataset.color === 'blue') {
        heroChart.data.datasets[1].data[1]++;
    } else {
        heroChart.data.datasets[1].data[2]++;
    }
    });

    arr = $('.deckViewerSpellList').find('li').toArray();
    manaChart.data.datasets.forEach(function (dataset) {
        dataset.data = [0,0,0,0,0,0,0,0,0,0];
    });
    arr.forEach((spell) => {
        if (spell.dataset.mana !== '-') {
        if (spell.dataset.color === 'red') {
            manaChart.data.datasets[0].data[parseInt(spell.dataset.costs)] += parseInt(spell.dataset.amount);
        } else if (spell.dataset.color === 'black') {
            manaChart.data.datasets[1].data[parseInt(spell.dataset.costs)] += parseInt(spell.dataset.amount);
        } else if (spell.dataset.color === 'blue') {
            manaChart.data.datasets[2].data[parseInt(spell.dataset.costs)] += parseInt(spell.dataset.amount);
        } else {
            manaChart.data.datasets[3].data[parseInt(spell.dataset.costs)] += parseInt(spell.dataset.amount);
        }
    }
    if (spell.dataset.color === 'red') {
        heroChart.data.datasets[0].data[3]++;
    } else if (spell.dataset.color === 'black') {
        heroChart.data.datasets[0].data[0]++;
    } else if (spell.dataset.color === 'blue') {
        heroChart.data.datasets[0].data[1]++;
    } else {
        heroChart.data.datasets[0].data[2]++;
    }
    });
    manaChart.update();
    heroChart.update();
    // Code for submitting likes
    $('#likeButton').on('click', function() {
        // console.log($(this).data('deckid'));
        const deckId = $(this).data('deckid');
        $.ajax({
            url: '/decks?view=upvote',
            type: 'POST',
            data: {
                deckId: $(this).data('deckid')
            },
            success: function(result) {
                // console.log(result);

                const res = JSON.parse(result);
                if (res.success) {;
                    $('#likeCounter').html(res.upvotes);
                } else {
                    alert(res.message);
                }
            }
        })
    });
    // Code for publish/unpublish
    $('#publish').on('click', function() {

        $.ajax({
            url: '/decks?view=publish',
            type: 'POST',
            data: {
                deckId: $(this).data('deckid'),
                status: $(this).data('status')
            },
            success: function(result) {
                // console.log(result);

                const res = JSON.parse(result);
                alert(res.message);
                if (res.success) {

                    if(res.status) { //published
                        $("#publish").removeClass("btn-success").addClass("btn-danger");
                        $("#publish").text('Unpublish');
                    }else {
                        $("#publish").removeClass("btn-danger").addClass("btn-success");
                        $("#publish").text('Publish');
                    }
                }
            }
        })
    });
</script>