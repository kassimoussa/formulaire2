<div class="py-3 px-3">

    <x-loading-indicator />

    <div class="d-flex justify-content-between mb-4">
        <h3 class="over-title mb-2">Statistiques </h3>

    </div>


    <div class="container">

        <div class="row">
            <div class="col-sm-12 col-md-4 col-lg-4  mb-4  ">
                <div class="card ">
                    <div class="card-header text-center d-flex justify-content-center">
                        <h3 class=""> Par Méthode </h3>
                    </div>
                    <div class="card-body">
                        <canvas id="chartByMethode" height="300" wire:ignor></canvas>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-4 col-lg-4  mb-4  ">
                <div class="card ">
                    <div class="card-header text-center d-flex justify-content-center">
                        <h3 class=""> Par pièce </h3>
                    </div>
                    <div class="card-body">
                        <canvas id="chartByPiece" height="300" wire:ignor></canvas>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-4 col-lg-4  mb-4  ">
                <div class="card ">
                    <div class="card-header text-center d-flex justify-content-center">
                        <h3 class=""> Par jour </h3>
                    </div>
                    <div class="card-body">
                        <canvas id="chartByJour" height="300" wire:ignor></canvas>
                    </div>
                </div>
            </div>


        </div>
    </div>


    <script>
    
        new Chart(document.getElementById("chartByJour"), {
            type: 'line',
            data: {
                labels: @json($jours),
                datasets: [{
                    data: @json($jclients),
                    label: "Enregistrement des client par jour",
                    borderColor: "#c45850",
                    fill: false
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                title: {
                    display: true,
                    text: 'Enregistrement des client par jour'
                }
            }
        });



        var total_cni =  @json($total_cni);
        var total_passport = @json($total_passport);
        var total_titre_sejour = @json($total_titre_sejour);
        var total_carte_refugie = @json($total_titre_sejour);

        var label = ['CNI (' + total_cni + ')', 'Passport (' + total_passport + ')', 'Titre de séjour (' + total_titre_sejour + ')', 'Carte de réfugié (' + total_carte_refugie + ')'
        ];
        var total = [total_cni, total_passport, total_titre_sejour, total_carte_refugie];

        new Chart(document.getElementById("chartByPiece"), {
            type: 'bar',
            data: {
                labels: label,
                datasets: [{
                    label: "Par pièce d'identité",
                    data: total,
                    backgroundColor: ['#1BE3CCDE', "#97BBDB", "#C280E0", "#DC9B73"],
                    borderColor: ['#16D2BCDE', '#91B8DB', "#A972C2", "#BB8360"],
                }]
            },
            options: {
                barThickness: 50,
                minBarLength: 3,
                responsive: true,
                maintainAspectRatio: false,
                title: {
                    display: true,
                    text: "Par pièce d'identité"
                }
            }
        });
        
        var total_o_client =  @json($total_o_client);
        var total_a_client = @json($total_a_client); 

        var label = ['En ligne (' + total_o_client + ')', 'En agence  (' + total_a_client + ')'];
        var total = [total_o_client, total_a_client];

        new Chart(document.getElementById("chartByMethode"), {
            type: 'bar',
            data: {
                labels: label,
                datasets: [{
                    label: "Par Méthode ",
                    data: total,
                    backgroundColor: ['#f9be2a', "#002565"],
                    borderColor: ['#CFA436', '#051F4D'],
                }]
            },
            options: {
                barThickness: 50,
                minBarLength: 3,
                responsive: true,
                maintainAspectRatio: false,
                title: {
                    display: true,
                    text: 'Par Méthode'
                }
            }
        });
        
    </script>




</div>
