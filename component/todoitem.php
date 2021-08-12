<script>
    class TodoItem extends React.Component {
        handleToggle = e => this.props.onToggle(this.props.id)

        handleDelete = e => this.props.onDelete(this.props.id)

        render() {
            const { id, name, done } = this.props

            return (
                h('li', null,
                    h('span', { className: 'badge bg-primary' }, id),
                    ' ',
                    done ? h('s', null, name) : name,
                    ' ',
                    h('button', { className: 'btn btn-secondary btn-sm', onClick: this.handleToggle }, 'Toggle'),
                    ' ',
                    h('button', { className: 'btn btn-outline-danger btn-sm', onClick: this.handleDelete }, 'Delete'),
                )
            )
        }
    }
</script>
