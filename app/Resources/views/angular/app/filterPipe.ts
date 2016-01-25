import {Pipe} from 'angular2/core';
@Pipe({
    name: 'filterPipe'
})

export class FilterPipe {
  transform(value,[letter]){
    if (letter){
        return value.filter((site) => site.description.toLowerCase().includes(letter.toLowerCase()));
    }
    return value;
  }
    // transform(items: any[], args: string): any {
    //     var tempItems = items;
    //     if (args && items) {
    //         var newItems = tempItems.filter(item => item.description.indexOf(args) !== -1);
    //         return newItems;
    //     }
    //     return items
    // }
}
