#include <stdio.h>
#include <string.h>
#include <stdlib.h>
#include <unistd.h>
#include <stdlib.h>  // rand(), srand()
#include <time.h>

int main(int argc, const char * argv[]){

    // srand(time(NULL));

    // int a = (rand() % 10) +1;

    unsigned int microseconds = 5000000;

    usleep(microseconds);


    FILE *fPtr;  //讀取的txt檔  
    FILE *fOut;

    fPtr = fopen(argv[1], "r");
    fOut = fopen(argv[2], "w");
    
    for (char ch = getc(fPtr); ch!=EOF;ch = getc(fPtr))   //逐字讀取txt內容
    {
        fprintf(fOut, "%c\n", ch);
    }

    printf("test1cOver\n");


    fclose(fPtr);
    fclose(fOut);

    return 0;


}
