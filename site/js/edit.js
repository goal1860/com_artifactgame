$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip({html: true});
    $('form').trigger("reset");
    localStorage.clear();
    const table = $('#hero-table').DataTable({
        lengthChange: false,
        responsive: true,
        columnDefs: [
            {
                targets: [ 6 ],
                visible: false,
                searchable: true
            }
        ]
    });
    const table1 = $('#spell-table').DataTable({
        lengthChange: false,
    });
    const table2 = $('#item-table').DataTable({
        lengthChange: false,
        columnDefs: [
            {
                targets: [ 2 ],
                visible: false,
                searchable: true
            }
        ]
    });
    toastr.options = {
        'timeOut': 2000
    }

    let global = {
        value: 1,
        itemcards: 9,
        herocards: 5,
        spellcards: 35
    };

    $('#deckBuilderReset').on('click', function() {
        localStorage.setItem('deck-builder', 1);
        global = $('#deckBuilderRules').find('option[value=1]').data();
        setValues();
    });

    $('#deckBuilderSubmit').on('submit', function(e){
        e.preventDefault();
    });

    let maxHero = global.herocards;
    let maxSpell = global.value === 1 ? global.spellcards : 999;
    let maxItem = global.value === 1 ? global.itemcards : 999;

    if(localStorage.getItem('deck-builder')) {
        $('#deckBuilderRules').val(localStorage.getItem('deck-builder'));
        global = $('#deckBuilderRules').find(':selected').data();
        setValues();
    }

    $('.total-heroes').html(maxHero);
    $('.total-spells').html(global.spellcards);
    $('.total-items').html(global.itemcards);
    $('#deckBuilderRules').on('change', function() {
        global = $(this).find(':selected').data();
        localStorage.setItem('deck-builder', $(this).val());
        setValues();
    });

    function setValues() {
        maxHero = global.herocards;
        maxSpell = global.value === 1 ? global.spellcards : 999;
        maxItem = global.value === 1 ? global.itemcards : 999;
        $('.total-heroes').html(maxHero);
        $('.total-spells').html(global.spellcards);
        $('.total-items').html(global.itemcards);
    }

    /**
     * Code for filtering by hero name and/or skill/effect
     */
    const heroTextSearch = [0,6];
    $('#checkName').on('change', function() {
        if ($('#checkName:checked').length === 0) {
            heroTextSearch.splice(heroTextSearch.indexOf(0), 1);
        } else {
            heroTextSearch.push(0);
        }
    });
    $('#checkSkill').on('change', function() {
        if ($('#checkSkill:checked').length === 0) {
            heroTextSearch.splice(heroTextSearch.indexOf(6), 1);
        } else {
            heroTextSearch.push(6);
        }
    });
    $('#hero-text').on('keyup', function() {
        multiSearch(table, heroTextSearch, $(this).val());
    });
    /**
     * Code for filtering by color
     */
    const colors = ['red', 'green', 'blue', 'black'];
    $('.color-hero').on('change', function () {
        const color = $(this).attr('id');
        if ($('#' + color + ':checked').length === 0) {
            const index = colors.indexOf(color)
            colors.splice(index, 1);
        } else {
            colors.push(color);
        }

        if (colors.length > 0) {
            search = colors.toString().split(',').join('|');
        } else {
            search = null;
        }
        table.column(1)
            .search(search, true, false)
            .draw();
    });
    /**
     * Code for filtering by rarity
     */
    const rarities = ['basic', 'common', 'uncommon', 'rare'];
    $('.rarity-hero').on('change', function () {
        const rarity = $(this).attr('id');
        if ($('#' + rarity + ':checked').length === 0) {
            const index = rarities.indexOf(rarity)
            rarities.splice(index, 1);
        } else {
            rarities.push(rarity);
        }
        console.log(rarities);
        let search;
        if (rarities.length > 0) {
            search = rarities.toString().split(',').join('|');
        } else {
            search = null
        }
        table.column(6)
            .search(search, true, false)
            .draw();
    });
    /**
     * For attack
     */
    $('#a_attack_op').on('change', filterFunction.bind(null, ['#a_attack_op', '#a_attack_nb', '#a_attack_nb_max', '.attackBetween', 2, table]));
    $('#a_attack_nb').on('keyup change', filterFunction.bind(null, ['#a_attack_op', '#a_attack_nb', '#a_attack_nb_max', '.attackBetween', 2, table]));
    $('#a_attack_nb_max').on('keyup change', filterFunction.bind(null, ['#a_attack_op', '#a_attack_nb', '#a_attack_nb_max', '.attackBetween', 2, table]));

    /**
     * For Armor
     */
    $('#a_armor_op').on('change', filterFunction.bind(null, ['#a_armor_op', '#a_armor_nb', '#a_armor_nb_max', '.armorBetween', 3, table]));
    $('#a_armor_nb').on('keyup change', filterFunction.bind(null, ['#a_armor_op', '#a_armor_nb', '#a_armor_nb_max', '.armorBetween', 3, table]));
    $('#a_armor_nb_max').on('keyup change', filterFunction.bind(null, ['#a_armor_op', '#a_armor_nb', '#a_armor_nb_max', '.armorBetween', 3, table]));

    /**
     * For Health
     */
    $('#a_health_op').on('change', filterFunction.bind(null, ['#a_health_op', '#a_health_nb', '#a_health_nb_max', '.healthBetween', 4, table]));
    $('#a_health_nb').on('keyup change', filterFunction.bind(null, ['#a_health_op', '#a_health_nb', '#a_health_nb_max', '.healthBetween', 4, table]));
    $('#a_health_nb_max').on('keyup change', filterFunction.bind(null, ['#a_health_op', '#a_health_nb', '#a_health_nb_max', '.healthBetween', 4, table]));

    /**
     * Hero Selection
     */
    let selectedHeroes = [];
    let spellCount = 0;
    let selectedSpell = [];
    let itemCount = 0;
    let selectedItems = [];
    if(localStorage.getItem('selected-heroes')) {
        selectedHeroes = JSON.parse(localStorage.getItem('selected-heroes'));
        maxHero = maxHero - selectedHeroes.length;
        generateHero();
        selectedHeroes.forEach((hero) => {
            $('#hero-table').find('tbody>tr[data-name="' + hero.name + '"]').addClass('selected-color');
        $('#hero-table').find('tbody>tr[data-name="' + hero.name + '"]').data('count', 0);
    });
    }
    $('#hero-table').on('click', '.selectHero', function () {
        if (maxHero > 0) {
            if ($(this).data('count') === 1) {
                if ($(this).data('signature')) {
                    const data = {
                        id: $(this).data('spell-id'),
                        color: $(this).data('color'),
                        name: $(this).data('signature'),
                        mana: $(this).data('mana'),
                        hero: $(this).data('name'),
                        count: 3,
                        status: 1
                    };
                    selectedSpell.unshift(data);
                    localStorage.setItem('selected-spells', JSON.stringify(selectedSpell));
                    spellCount += 3;
                    generateSpell();
                }
                $(this).addClass('selected-color');
                maxHero--;
                const data = {
                    id: $(this).data('id'),
                    color: $(this).data('color'),
                    name: $(this).data('name')
                };
                selectedHeroes.push(data);
                localStorage.setItem('selected-heroes', JSON.stringify(selectedHeroes));
                generateHero();
                $(this).data('count', 0);
            } else {
                toastr.error('Max. 1 of the same hero card allowed.');
            }
        } else {
            toastr.error('Max. 5 heroes allowed.');
        }
    });


    function generateHero() {
        heroChart.data.datasets[1].data = [0, 0, 0, 0];
        let html = '';
        $('.no-of-heroes').html(5 - maxHero);
        if (maxHero === 5) {
            html += '<li class="list-group-item d-flex justify-content-center align-items-center p-1 noselect">-</li>';
        } else {
            selectedHeroes.forEach(function (hero, index) {
                if (index === 0) {
                    html += '<li class="list-group-item d-flex justify-content-center align-items-center p-1 noselect" style="font-weight:bold">Initial</li>';
                } else if (index === 3) {
                    html += '<li class="list-group-item d-flex justify-content-center align-items-center p-1 noselect" style="font-weight:bold">Reserve</li>';
                }
                html += '<li class="list-group-item p-1 hero" data-index="' + index + '" data-name="' + hero.name + '"><span class="d-flex align-items-center"><span class="mx-2">1×</span><span class="badge badge-pill mr-2 cardcolor-' + hero.color + ' hero-' + hero.color + '">.</span>' + hero.name + '<span class="badge badge-danger cross text-center cursorfinger mr-2 float-right">-</span></span></li>';

                if (hero.color.toLowerCase() === 'red') {
                    heroChart.data.datasets[1].data[3]++;
                } else if (hero.color.toLowerCase() === 'black') {
                    heroChart.data.datasets[1].data[0]++;
                } else if (hero.color.toLowerCase() === 'blue') {
                    heroChart.data.datasets[1].data[1]++;
                } else {
                    heroChart.data.datasets[1].data[2]++;
                }
            });
        }

        heroChart.update();
        $('.deckBuilderHeroList').html(html);
    }
    $(document).on('click', '.cross', function () {
        let index = $(this).parent('span').parent('li').data('index');
        selectedHeroes.splice(index, 1);
        const name = $(this).parent('span').parent('li').data('name');
        const sigCard = $('#hero-table').find('tbody>tr[data-name="' + name + '"]').data('signature');
        index = selectedSpell.findIndex((spell) => spell.name === sigCard);
        if (index !== -1) {
            const spell = selectedSpell.splice(index, 1)[0];
            spellCount -= spell.count;
        }
        maxHero++;
        localStorage.setItem('selected-heroes', JSON.stringify(selectedHeroes));
        localStorage.setItem('selected-spells', JSON.stringify(selectedSpell));
        generateHero();
        generateSpell();
        $('#hero-table').find('tbody>tr[data-name="' + name + '"]').removeClass('selected-color');
        $('#hero-table').find('tbody>tr[data-name="' + name + '"]').data('count', 1);
    });

    /** Codes for Spell table */
    /**
     * Code for filtering by color
     */
    const colors1 = ['red', 'green', 'blue', 'black'];
    $('.color-spell').on('change', function () {
        const color = $(this).attr('id');
        if ($('#' + color + ':checked').length === 0) {
            const index = colors1.indexOf(color.split('a_')[1])
            colors1.splice(index, 1);
        } else {
            colors1.push(color.split('a_')[1]);
        }
        let search;
        if (colors1.length > 0) {
            search = colors1.toString().split(',').join('|');
        } else {
            search = null;
        }
        table1.column(1)
            .search(search, true, false)
            .draw();
    });
    /**
     * Code for filtering by spell name and/or skill/effect
     */
    const spellTextSearch = [0,3];
    $('#checkName1').on('change', function() {
        if ($('#checkName1:checked').length === 0) {
            spellTextSearch.splice(spellTextSearch.indexOf(0), 1);
        } else {
            spellTextSearch.push(0);
        }
    });
    $('#checkSkill1').on('change', function() {
        if ($('#checkSkill1:checked').length === 0) {
            spellTextSearch.splice(spellTextSearch.indexOf(3), 1);
        } else {
            spellTextSearch.push(3);
        }
    });
    $('#spell-text').on('keyup', function() {
        multiSearch(table1, spellTextSearch, $(this).val());
    });
    /**
     * Code for filtering by rarity
     */
    const rarities1 = ['basic', 'common', 'uncommon', 'rare'];
    $('.rarity-spell').on('change', function () {
        const rarity = $(this).attr('id');
        if ($('#' + rarity + ':checked').length === 0) {
            const index = rarities1.indexOf(rarity.split('s_')[1])
            rarities1.splice(index, 1);
        } else {
            rarities1.push(rarity.split('s_')[1]);
        }
        let search;
        if (rarities1.length > 0) {
            search = rarities1.toString().split(',').join('|');
        } else {
            search = null
        }
        table1.column(4)
            .search(search, true, false)
            .draw();
    });
    /**
     * For mana
     */
    $('#a_mana_op').on('change', filterFunction.bind(null, ['#a_mana_op', '#a_mana_nb', '#a_mana_nb_max', '.manaBetween', 2, table1]));
    $('#a_mana_nb').on('keyup change', filterFunction.bind(null, ['#a_mana_op', '#a_mana_nb', '#a_mana_nb_max', '.manaBetween', 2, table1]));
    $('#a_mana_nb_max').on('keyup change', filterFunction.bind(null, ['#a_mana_op', '#a_mana_nb', '#a_mana_nb_max', '.manaBetween', 2, table1]));

    /**
     * For selecting spell
     */
    if(localStorage.getItem('selected-spells')) {
        selectedSpell = JSON.parse(localStorage.getItem('selected-spells'));
        selectedSpell.forEach((spell) => {
            spellCount += spell.count;
        const count = spell.count;
        if(!spell.status) {
            $('#spell-table').find('tbody>tr[data-name="' + spell.name + '"]').addClass('selected-color');
            $('#spell-table').find('tbody>tr[data-name="' + spell.name + '"]').data('count', 3-count);
        }
    });
        maxSpell = maxSpell - spellCount;
        generateSpell();
    }
    $('#spell-table').on('click', '.selectSpell', function () {
        const count = parseInt($(this).data('count'));
        if (maxSpell > 0) {
            if (count > 0) {
                spellCount++;
                if(count === 1) {
                    $(this).addClass('selected-color');
                }
                const data = {
                    id: $(this).data('id'),
                    color: $(this).data('color'),
                    name: $(this).data('name'),
                    mana: $(this).data('mana'),
                    count: 1
                };
                const index = selectedSpell.findIndex(function (spell, index) {
                    return spell.name === data.name;
                });
                if (index !== -1) {
                    selectedSpell[index].count++;
                } else {
                    selectedSpell.push(data);
                }
                maxSpell--;
                localStorage.setItem('selected-spells', JSON.stringify(selectedSpell));
                generateSpell();
                $(this).data('count', count-1);
            } else {
                alert('Max. 3 of the same spell card allowed.');
            }
        } else {
            alert('Max. ' + global.spellcards + ' spells allowed.');
        }
        console.log(maxSpell);
    });


    function generateSpell() {
        $('.no-of-spells').html(spellCount);
        manaChart.data.datasets.forEach(function (dataset) {
            dataset.data = [0,0,0,0,0,0,0,0,0,0];
        });
        heroChart.data.datasets[0].data = [0, 0, 0, 0];
        let html = '';
        if (spellCount === 0) {
            html += '<li class="list-group-item d-flex justify-content-center align-items-center p-1 noselect">-</li>';
        } else {
            selectedSpell.forEach(function (spell, index) {
                if (!spell.status) {
                    html += '<li class="list-group-item p-1 hero" data-index="' + index + '" data-name="' + spell.name + '"><span class="d-flex align-items-center"><span class="d-flex align-items-center"><span class="mx-2">'+ spell.count +'×</span><span class="badge badge-pill mr-2 cardcolor-' + spell.color + '">' + spell.mana + '</span>' + spell.name + '</span>';
                    html += '<span class="badge badge-danger cursorfinger cross1 text-center mr-2 float-right">-</span></span>';
                } else {
                    html += '<li class="list-group-item p-1 hero" data-index="' + index + '" data-name="' + spell.name + '"><span class="d-flex align-items-center"><span class="d-flex align-items-center"><span class="mx-2">'+ spell.count +'×</span><span class="badge badge-pill mr-2 cardcolor-' + spell.color + '">' + spell.mana + '</span>' + spell.name + ' (' + spell.hero + '\'s Signature)</span>';
                }
                html += '</li>';
                if (spell.mana !== '-') {
                    if (spell.color.toLowerCase() === 'red') {
                        manaChart.data.datasets[0].data[spell.mana] += spell.count;
                    } else if (spell.color.toLowerCase() === 'black') {
                        manaChart.data.datasets[1].data[spell.mana] += spell.count;
                    } else if (spell.color.toLowerCase() === 'blue') {
                        manaChart.data.datasets[2].data[spell.mana] += spell.count;
                    } else {
                        manaChart.data.datasets[3].data[spell.mana] += spell.count;
                    }
                }
                if (spell.color.toLowerCase() === 'red') {
                    heroChart.data.datasets[0].data[3]++;
                } else if (spell.color.toLowerCase() === 'black') {
                    heroChart.data.datasets[0].data[0]++;
                } else if (spell.color.toLowerCase() === 'blue') {
                    heroChart.data.datasets[0].data[1]++;
                } else {
                    heroChart.data.datasets[0].data[2]++;
                }
            });
        }
        //console.log(manaChart.data);
        manaChart.update();
        heroChart.update();
        $('.deckBuilderSpellList').html(html);
    }
    $(document).on('click', '.cross1', function () {
        spellCount--;
        const index = $(this).parent('span').parent('li').data('index');
        const name = $(this).parent('span').parent('li').data('name');
        const count = $('#spell-table').find('tbody>tr[data-name="' + name + '"]').data('count');
        if(count === 0) {
            $('#spell-table').find('tbody>tr[data-name="' + name + '"]').removeClass('selected-color');
        }
        console.log(count);
        if (selectedSpell[index].count > 1) {
            selectedSpell[index].count--;
        } else {
            selectedSpell.splice(index, 1);
        }
        localStorage.setItem('selected-spells', JSON.stringify(selectedSpell));
        generateSpell();
        $('#spell-table').find('tbody>tr[data-name="' + name + '"]').data('count', count+1);
        maxSpell ++;
        console.log(maxSpell);
    });
    /** Codes for Item table */
    /**
     * Code for filtering by rarity
     */
    const rarities2 = ['basic', 'common', 'uncommon', 'rare'];
    $('.rarity-item').on('change', function () {
        const rarity = $(this).attr('id');
        if ($('#' + rarity + ':checked').length === 0) {
            const index = rarities2.indexOf(rarity.split('i_')[1])
            rarities2.splice(index, 1);
        } else {
            rarities2.push(rarity.split('i_')[1]);
        }
        let search;
        if (rarities2.length > 0) {
            search = rarities2.toString().split(',').join('|');
        } else {
            search = null
        }
        table2.column(2)
            .search(search, true, false)
            .draw();
    });
    /**
     * Code for filtering by spell name and/or skill/effect
     */
    const itemTextSearch = [0,2];
    $('#checkName2').on('change', function() {
        if ($('#checkName2:checked').length === 0) {
            itemTextSearch.splice(itemTextSearch.indexOf(0), 1);
        } else {
            itemTextSearch.push(0);
        }
    });
    $('#checkSkill2').on('change', function() {
        if ($('#checkSkill2:checked').length === 0) {
            itemTextSearch.splice(itemTextSearch.indexOf(2), 1);
        } else {
            itemTextSearch.push(2);
        }
    });
    $('#item-text').on('keyup', function() {
        multiSearch(table2, itemTextSearch, $(this).val());
    });
    /**
     * For gold cost
     */
    $('#a_gold_op').on('change', filterFunction.bind(null, ['#a_gold_op', '#a_gold_nb', '#a_gold_nb_max', '.goldBetween', 1, table2]));
    $('#a_gold_nb').on('keyup change', filterFunction.bind(null, ['#a_gold_op', '#a_gold_nb', '#a_gold_nb_max', '.goldBetween', 1, table2]));
    $('#a_gold_nb_max').on('keyup change', filterFunction.bind(null, ['#a_gold_op', '#a_gold_nb', '#a_gold_nb_max', '.goldBetween', 1, table2]));
    /**
     * Item Selection
     */
    if(localStorage.getItem('selected-items')) {
        selectedItems = JSON.parse(localStorage.getItem('selected-items'));
        let localItemCount = 0;
        selectedItems.forEach((item) => {
            localItemCount += item.count;
        $('#item-table').find('tbody>tr[data-name="' + item.name + '"]').addClass('selected-color');
        $('#item-table').find('tbody>tr[data-name="' + item.name + '"]').data('count', 3 - item.count);
    });
        maxItem = maxItem - localItemCount;
        itemCount = localItemCount;
        generateItem();
    }
    $('#item-table').on('click', '.selectItem', function () {
        const count = parseInt($(this).data('count'));
        console.log(maxItem);
        if (maxItem > 0) {
            if (count > 0) {
                itemCount++;
                if(count === 1) {
                    $(this).addClass('selected-color');
                }
                const data = {
                    id: $(this).data('id'),
                    name: $(this).data('name'),
                    gold: $(this).data('gold'),
                    count: 1
                };
                const index = selectedItems.findIndex(function (spell, index) {
                    return spell.name === data.name;
                });
                if (index !== -1) {
                    selectedItems[index].count++;
                } else {
                    selectedItems.push(data);
                }
                maxItem--;
                localStorage.setItem('selected-items', JSON.stringify(selectedItems));
                generateItem();
                $(this).data('count', count-1);
            } else {
                alert('Max. 3 of the same items card allowed.');
            }
        } else {
            alert('Max. ' + global.itemcards + ' items allowed.');
        }
    });

    function generateItem() {
        goldChart.data.datasets[0].data = [];
        goldChart.data.labels = [];
        let maxGold = 0;
        $('.no-of-items').html(itemCount);
        let html = '';
        if (itemCount === 0) {
            html += '<li class="list-group-item d-flex justify-content-center align-items-center p-1 noselect">-</li>';
        } else {
            selectedItems.forEach(function (item, index) {
                html += '<li class="list-group-item p-1 hero" data-index="' + index + '" data-name="' + item.name + '"><span class="d-flex align-items-center"><span class="d-flex align-items-center"><span class="mx-2">' + item.count + '×</span><div class="badge-item-width"><span class="badge badge-warning badge-pill mr-2">' + item.gold + '</span></div>' + item.name + '</span><span class="badge badge-danger cross2 cursorfinger text-center mr-2 float-right">-</span></span></li>';
                if(item.gold !== '-') {
                    maxGold = maxGold < item.gold ? item.gold : maxGold;
                }
            });
        }
        $('.deckBuilderItemList').html(html);
        for(let i=0;i<=maxGold; ++i) {
            goldChart.data.labels.push(i);
            goldChart.data.datasets[0].data[i] = 0;
        }
        selectedItems.forEach(function (item, index) {
            goldChart.data.datasets[0].data[item.gold] += item.count;
        });
        goldChart.update();
    }

    $(document).on('click', '.cross2', function () {
        itemCount--;
        maxItem++;
        const index = $(this).parent('span').parent('li').data('index');
        const name = $(this).parent('span').parent('li').data('name');
        const count = $('#item-table').find('tbody>tr[data-name="' + name + '"]').data('count');
        if(count === 0) {
            $('#item-table').find('tbody>tr[data-name="' + name + '"]').removeClass('selected-color');
        }
        console.log(count);
        if (selectedItems[index].count > 1) {
            selectedItems[index].count--;
        } else {
            selectedItems.splice(index, 1);
        }
        localStorage.setItem('selected-items', JSON.stringify(selectedItems));
        generateItem();
        $('#item-table').find('tbody>tr[data-name="' + name + '"]').data('count', count+1);
    });

    // Submitting data to database via ajax call
    $('#deckBuilderSave').on('click', function(){
        if ($('#deckName').val() !== '' && $('#deckDesc').val() !== '' && $('#deckDesc').val().length >= 10 ) {
            $.ajax({
                url: 'decks?view=save',
                type: 'POST',
                data: {
                    id: $('#deckId').val(),
                    deckFormat: $('#deckBuilderRules').val(),
                    deckName: $('#deckName').val(),
                    deckDesc: $('#deckDesc').val(),
                    heroes: selectedHeroes,
                    spells: selectedSpell,
                    items: selectedItems
                },
                success: function(result) {
                    const res = JSON.parse(result);
                    if (res.success) {
                        localStorage.clear();
                        alert(res.message);
                        setTimeout(() => {
                            window.location.href = '/decks';
                    }, 2000);
                    } else {
                        alert(res.message + " Redirecting...");
                    }
                }
            });
        }
    });
    $('#deckBuilderReset').on('click', function(){
        localStorage.clear();
        location.reload();
    });
    $.ajax({
        url: '/decks?view=deckInfo&id=' + $('#deckId').val(),
        method: 'GET',

        success: function (response) {
            const result = JSON.parse(response);
            selectedHeroes = result.hero;
            localStorage.setItem('selected-heroes', JSON.stringify(selectedHeroes));
            selectedSpell = result.spell;
            localStorage.setItem('selected-spells', JSON.stringify(selectedSpell));
            selectedItems = result.item;
            localStorage.setItem('selected-items', JSON.stringify(selectedItems));
            loadData();
            $('#deckName').val(result.name);
            $('#deckDesc').val(result.description);
        }
    });

    function loadData() {
        if (localStorage.getItem('selected-heroes')) {
                selectedHeroes = JSON.parse(localStorage.getItem('selected-heroes'));
                maxHero = maxHero - selectedHeroes.length;
                generateHero();
                selectedHeroes.forEach((hero) => {
                    $('#example').find('tbody>tr[data-name="' + hero.name + '"]').addClass('selected-color');
                $('#example').find('tbody>tr[data-name="' + hero.name + '"]').data('count', 0);
            });
        }
        if (localStorage.getItem('selected-spells')) {
            selectedSpell = JSON.parse(localStorage.getItem('selected-spells'));
            selectedSpell.forEach((spell) = > {
                spellCount += parseInt(spell.count);
            const count = parseInt(spell.count);
            if (!spell.status) {
                $('#example1').find('tbody>tr[data-name="' + spell.name + '"]').addClass('selected-color');
                $('#example1').find('tbody>tr[data-name="' + spell.name + '"]').data('count', 3 - count);
            }
        });
            //console.log(spellCount);
            maxSpell = maxSpell - spellCount;
            generateSpell();
        }
        if (localStorage.getItem('selected-items')) {
            selectedItems = JSON.parse(localStorage.getItem('selected-items'));
            let localItemCount = 0;
            selectedItems.forEach((item) = > {
                localItemCount += parseInt(item.count);
            $('#example2').find('tbody>tr[data-name="' + item.name + '"]').addClass('selected-color');
            $('#example2').find('tbody>tr[data-name="' + item.name + '"]').data('count', 2 - item.count);
        })
            ;
            maxItem = maxItem - localItemCount;
            itemCount = localItemCount;
            generateItem();
        }
    }

});