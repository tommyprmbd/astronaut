<x-edit-link :route="route($route . '.edit', $model->id)" />
<x-destroy-button :route="route($route . '.destroy', $model->id)" />