<template>
    <div>
        <!-- nav -->
        <job-nav></job-nav>
        <!-- list -->
        <job-list></job-list>
    </div>
</template>

<script>
import JobNav from '@/components/JobNav'
import JobList from '@/components/JobList'

export default {
    name: 'JobIndex',
    components: {
        JobNav,
        JobList
    }
}
</script>