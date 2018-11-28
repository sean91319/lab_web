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

    char arr[500]={0};
    int i =0;
    int count=0;
    char ch = getc(fPtr);

    
    for (; ch!=EOF;i++)   //逐字讀取txt內容
    {
        arr[i]=ch;
        count++;
        ch = getc(fPtr);
    }

    int j;

    for (j=0; j < count; j=j+2)
    {
        fprintf(fOut, "%c", arr[j]);
    }
    printf("test2cOver\n");

    fclose(fPtr);
    fclose(fOut);

    return 0;


}
