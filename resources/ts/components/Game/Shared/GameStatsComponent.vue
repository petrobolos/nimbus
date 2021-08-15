<template>
    <div class="table-responsive text-center">
        <table class="table table-sm table-bordered align-middle">
            <thead class="table-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">HP</th>
                <th scope="col">SP</th>
                <th scope="col">Attack</th>
                <th scope="col">Defense</th>
                <th scope="col">Speed</th>
                <th scope="col">Special</th>
                <th scope="col">Spirit</th>
            </tr>
            </thead>
            <tbody class="table-striped">
            <tr>
                <th scope="row">You</th>
                <td>{{ player.hp }}</td>
                <td>{{ player.sp }}</td>
                <td>{{ player.attack }}</td>
                <td>{{ player.defense }}</td>
                <td>{{ player.speed }}</td>
                <td>{{ player.special }}</td>
                <td>{{ player.spirit }}</td>
            </tr>
            <tr>
                <th scope="row">Opponent</th>
                <td>{{ opponent.hp }}</td>
                <td>{{ opponent.sp }}</td>
                <td>{{ opponent.attack }}</td>
                <td>{{ opponent.defense }}</td>
                <td>{{ opponent.speed }}</td>
                <td>{{ opponent.special }}</td>
                <td>{{ opponent.spirit }}</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script lang="ts">
import { Component, Prop, Vue } from 'vue-property-decorator';
import FighterInterface from '../../../interfaces/fighter.interface';

@Component
export default class GameStatsComponent extends Vue {
    @Prop({ required: true }) readonly player!: FighterInterface;
    @Prop({ required: true }) readonly opponent!: FighterInterface;
}
</script>
