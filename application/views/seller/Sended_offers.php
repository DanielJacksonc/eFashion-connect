
<div class="container m-3">
    <div class="row">
        <div class="col text-center">
            <h4> Offer Sended </h4>
        </div>
    </div>
</div>

<div class="container p-3" id="offer_container">

    <?php

        $offers = array_reverse($offers);
        foreach ( $offers as $offer ) {
            ?>

                <div class="row bg-light border p-3 text-justify mb-3 rounded" >
                    <div class="col-sm-8 "> <?php echo $offer['des']; ?> </div>
                    <div class="col-sm-4 text-center">$ <?php echo $offer['price']; ?></div>
                </div>

            <?php
        }

    ?>

</div>
