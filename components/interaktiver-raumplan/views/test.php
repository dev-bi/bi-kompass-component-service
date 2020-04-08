<!-- Komponente: Interaktiver Raumplan -->
<!-- --------------------------------------------------- -->

<div>
    <h1>Der View wurde erfolgreich geladen :)</h1>
</div>

<script>
    let rooms = <?php echo json_encode($rooms); ?>;
    let floorData = {'rooms' : rooms};
</script>

<!-- --------------------------------------------------- -->
<!-- Komponente Ende-->
