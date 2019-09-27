<template>
    <div>
        <!-- list -->
        <job-list></job-list>
    </div>
</template>

<script>
import JobList from '@/components/JobList'

export default {
    name: 'JobIndex',
    components: {
        JobList
    }
}
</script>
