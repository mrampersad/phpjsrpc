<script>
    class Nav extends React.Component {
        render() {
            return (
                h('nav', { className: 'navbar navbar-expand navbar-light bg-light' },
                    h('div', { className: 'container-fluid' },
                        h('span', { className: 'navbar-brand mb-0 h1' }, 'Demo'),
                        h('ul', { className: 'navbar-nav me-auto mb-2 mb-lg-0' },
                            h('li', { className: 'nav-item' },
                                h('a', { className: 'nav-link', href: '<?php echo $routes['home']->pattern; ?>' }, 'Home')
                            ),
                            h('li', { className: 'nav-item' },
                                h('a', { className: 'nav-link', href: '<?php echo $routes['todo']->pattern; ?>' }, 'Todo')
                            ),
                        )
                    )
                )
            )
        }
    }
</script>
