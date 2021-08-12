<?php require_once 'nav.php'; ?>
<?php require_once 'greet.php'; ?>
<?php require_once 'namelist.php'; ?>
<script>
    class Demo extends React.Component {
        render() {
            return h('div', null, 
                h(Nav, null),
                h(Greet, null),
                h(NameList, null),
            );
        }
    }
</script>
