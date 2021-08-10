<template>
    <div class="row">
        <div class="col-md-8">
            <div class="card text-center">
                <div class="card-header">
                    Opponent
                </div>
                <img src="https://via.placeholder.com/150" class="card-img-top" alt="Opponent">
                <div class="card-body">
                    <h5 class="card-title">Opponent</h5>
                    <p class="card-text">Description</p>
                </div>
            </div>
            <game-stats-component></game-stats-component>
            <game-abilities-component></game-abilities-component>
        </div>

        <aside class="col-md-4">
            <div class="d-grid gap-2 mb-3">
                <button class="btn btn-warning btn-block" type="button">Report Issue</button>
                <button class="btn btn-danger btn-block" type="button">Disconnect</button>
            </div>
            <game-chat-component></game-chat-component>
        </aside>
    </div>
</template>

<script lang="ts">
import { Component, Prop, Vue } from 'vue-property-decorator';

@Component
export default class GameComponent extends Vue {
    @Prop({ required: true }) readonly game!: Object;
}
</script>
